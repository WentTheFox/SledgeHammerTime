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

  public static function cacheKey(string $page, string $locale): string {
    $version = Config::get('app.page_cache.version', 0);
    return "page-html-{$page}-{$locale}-v$version";
  }

  /**
   * Forget all locale variants of a cached page.
   * Call this whenever the underlying data for a page changes.
   */
  public static function forgetPage(string $page): void {
    foreach (array_keys(Config::get('languages.ui_locale_map', [])) as $locale) {
      Cache::forget(static::cacheKey($page, $locale));
    }
  }

  /**
   * Returns true only when the response is a complete, valid Inertia SSR page.
   *
   * Inertia's buildSSRBody() emits:
   *   <script data-page="{id}" type="application/json">{page JSON}</script>
   *   <div data-server-rendered="true" id="{id}">…rendered HTML…</div>
   *
   * The client-only fallback (SSR server unavailable) omits data-server-rendered
   * and leaves the div empty.  The data-page attribute value is always just the
   * element ID ("app"), not the JSON - the JSON is the script tag's text content.
   *
   * Checks performed:
   * 1. Must be a complete HTML document (DOCTYPE + closing </html>).
   * 2. Must contain data-server-rendered="true" - the sole reliable SSR indicator.
   * 3. The inline page-data script must contain parseable Inertia JSON with a
   *    "component" key; a truncated payload would break client-side hydration.
   */
  private function isValidPageContent(string|false $content): bool {
    if ($content === false || $content === '') return false;

    if (!str_contains($content, '<!DOCTYPE html') || !str_contains($content, '</html>')) {
      return false;
    }

    // Only present when the SSR server actually rendered the page
    if (!str_contains($content, 'data-server-rendered="true"')) {
      return false;
    }

    // Extract and validate the Inertia page JSON from the inline script tag.
    // Inertia escapes "/" as "\/" in the JSON so "</script>" never appears inside it.
    if (!preg_match('/<script\b[^>]*\btype="application\/json"[^>]*>(.+?)<\/script>/si', $content, $matches)) {
      return false;
    }

    $pageData = json_decode($matches[1], true);
    return is_array($pageData) && isset($pageData['component']);
  }

  /** @return array<string, string> */
  private function cacheHeaders(int $lastModifiedTimestamp): array {
    $lastModifiedFormatted = Carbon::createFromTimestampUTC($lastModifiedTimestamp)
      ->format('D, d M Y H:i:s') . ' GMT';

    return [
      'Cache-Control' => 'public, max-age=0, must-revalidate',
      'Last-Modified' => $lastModifiedFormatted,
    ];
  }

  public function handle(Request $request, Closure $next, string $page): Response {
    if (!Config::get('app.page_cache.enabled')) {
      return $next($request);
    }

    // Only cache responses for requests that match the configured app base URL.
    // Requests arriving via a different host (e.g. a raw server IP) are skipped.
    $appBaseUrl = rtrim(Config::get('app.url', ''), '/');
    if ($appBaseUrl !== '' && !str_starts_with($request->url(), $appBaseUrl)) {
      return $next($request);
    }

    // Inertia SPA navigations send X-Inertia header - serve those fresh so shared
    // props (crowdinData, ziggy, etc.) stay up to date across client-side navigations.
    if ($request->inertia()) {
      return $next($request);
    }

    $locale = App::getLocale();
    $cacheKey = static::cacheKey($page, $locale);

    /** @var array{html: string, last_modified: int}|string|null $cached */
    $cached = Cache::get($cacheKey);

    // Discard legacy cache entries that are plain strings (pre-format migration).
    if (is_string($cached)) {
      Cache::forget($cacheKey);
      $cached = null;
    }

    if ($cached !== null) {
      // Re-validate on every cache hit so corrupt or incomplete entries that
      // somehow passed the write-time check are evicted rather than served.
      if (!$this->isValidPageContent($cached['html'])) {
        Cache::forget($cacheKey);
        return $next($request);
      }

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

    if ($response->getStatusCode() === 200 && $this->isValidPageContent($response->getContent())) {
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
