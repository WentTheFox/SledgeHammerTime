<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class CachePageResponse {
  private const CACHE_TTL_SECONDS = 86400;

  public static function cacheKey(string $page, string $locale, string $manifestHash): string {
    return "page-html-{$page}-{$locale}-{$manifestHash}";
  }

  /**
   * Forget all locale variants of a cached page.
   * Call this whenever the underlying data for a page changes.
   */
  public static function forgetPage(string $page): void {
    $manifestHash = @md5_file(public_path('build/manifest.json')) ?: 'default';
    foreach (array_keys(Config::get('languages.ui_locale_map', [])) as $locale) {
      Cache::forget(static::cacheKey($page, $locale, $manifestHash));
    }
  }

  /**
   * Returns true only when the Inertia app container has SSR-rendered content.
   * When the SSR server is unavailable Laravel falls back to an empty container,
   * which must not be cached or subsequent visitors would receive a blank shell.
   */
  private function hasSSRContent(string|false $content): bool {
    if ($content === false) return false;
    // An empty app container looks like: <div id="app"></div>
    // A server-rendered one has child nodes between the tags.
    return !str_contains($content, '<div id="app"></div>');
  }

  /** @return array<string, string> */
  private function cacheHeaders(int $lastModifiedTimestamp): array {
    $lastModifiedFormatted = Carbon::createFromTimestampUTC($lastModifiedTimestamp)
      ->format('D, d M Y H:i:s') . ' GMT';

    return [
      'Cache-Control' => 'public, max-age=' . self::CACHE_TTL_SECONDS . ', must-revalidate',
      'Last-Modified' => $lastModifiedFormatted,
    ];
  }

  public function handle(Request $request, Closure $next, string $page): Response {
    // Inertia SPA navigations send X-Inertia header — serve those fresh so shared
    // props (crowdinData, ziggy, etc.) stay up to date across client-side navigations.
    if ($request->inertia()) {
      return $next($request);
    }

    $locale = App::getLocale();
    $manifestHash = @md5_file(public_path('build/manifest.json')) ?: 'default';
    $cacheKey = static::cacheKey($page, $locale, $manifestHash);

    /** @var array{html: string, last_modified: int}|null $cached */
    $cached = Cache::get($cacheKey);

    // Discard legacy cache entries that are plain strings (pre-format migration).
    if (is_string($cached)) {
      Cache::forget($cacheKey);
      $cached = null;
    }

    if ($cached !== null) {
      $lastModified = $cached['last_modified'];
      $headers = $this->cacheHeaders($lastModified);

      $ifModifiedSince = $request->headers->get('If-Modified-Since');
      if ($ifModifiedSince !== null) {
        $ifModifiedSinceTs = strtotime($ifModifiedSince);
        if ($ifModifiedSinceTs !== false && $ifModifiedSinceTs >= $lastModified) {
          return response('', 304, $headers);
        }
      }

      return response($cached['html'], 200, array_merge(
        ['Content-Type' => 'text/html; charset=UTF-8'],
        $headers,
      ));
    }

    $response = $next($request);

    if ($response->getStatusCode() === 200 && $this->hasSSRContent($response->getContent())) {
      $lastModified = now()->utc()->timestamp;
      Cache::put($cacheKey, [
        'html' => $response->getContent(),
        'last_modified' => $lastModified,
      ], self::CACHE_TTL_SECONDS);

      foreach ($this->cacheHeaders($lastModified) as $name => $value) {
        $response->headers->set($name, $value);
      }
    }

    return $response;
  }
}
