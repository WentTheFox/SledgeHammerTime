<?php

namespace App\Http\Middleware;

use App\Services\ContentSecurityPolicy;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sends the Content-Security-Policy in report-only mode (see ContentSecurityPolicy) with the report endpoint from
 * `app.csp.report_uri`; nothing is sent while that is empty. Set as a header on the final response, so it also covers
 * cached pages and never becomes part of the stored HTML.
 */
class AddContentSecurityPolicy {
  /**
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next): Response {
    $response = $next($request);

    $reportUri = (string)Config::get('app.csp.report_uri', '');
    if ($reportUri === '' || !$this->isHtmlDocument($response)) {
      return $response;
    }

    $hashes = ContentSecurityPolicy::inlineScriptHashes((string)$response->getContent());
    $response->headers->set('Content-Security-Policy-Report-Only', ContentSecurityPolicy::build($hashes, $reportUri));
    $response->headers->set('Reporting-Endpoints', ContentSecurityPolicy::reportingEndpoints($reportUri));

    return $response;
  }

  /** Only full pages carry scripts: not Inertia's JSON navigations, redirects, 304s or the API. */
  private function isHtmlDocument(Response $response): bool {
    if ($response->getStatusCode() === 304 || $response->isRedirection() || $response->headers->has('X-Inertia')) {
      return false;
    }

    return str_contains(strtolower((string)$response->headers->get('Content-Type')), 'text/html');
  }
}
