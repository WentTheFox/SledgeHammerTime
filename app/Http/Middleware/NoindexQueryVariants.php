<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Keeps URLs that only differ from a page by their query string out of search indexes.
 *
 * Crawlers follow these in bulk (every `?t=` is a new timestamp), which only adds near-duplicates of the plain page.
 * Sent as a header, so it also covers cached responses and never becomes part of the stored HTML. The URLs must stay
 * crawlable (no robots.txt rule), otherwise the crawlers never get to see the header.
 */
class NoindexQueryVariants {
  /** Parameters that mean "same page" wherever they appear (e.g. AMP-style links) */
  private const IGNORED_PARAMETERS = ['amp'];

  /** Parameters that select a specific timestamp/timezone, which only the picker supports */
  private const PICKER_PARAMETERS = ['t', 'tz'];

  /**
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next): Response {
    $response = $next($request);

    if ($this->isVariant($request)) {
      $response->headers->set('X-Robots-Tag', 'noindex');
    }

    return $response;
  }

  private function isVariant(Request $request): bool {
    if ($this->hasAny($request, self::IGNORED_PARAMETERS)) {
      return true;
    }

    return $request->route()?->getName() === 'home' && $this->hasAny($request, self::PICKER_PARAMETERS);
  }

  /** @param list<string> $names */
  private function hasAny(Request $request, array $names): bool {
    foreach ($names as $name) {
      // has() rather than a value check: `?amp` and `?amp=` both arrive as an empty string
      if ($request->query->has($name)) {
        return true;
      }
    }

    return false;
  }
}
