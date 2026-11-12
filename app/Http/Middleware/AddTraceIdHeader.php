<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use OpenTelemetry\API\Trace\Span;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exposes the OpenTelemetry trace id of the current request as `X-Trace-Id`, so a user can quote it in a bug report.
 * Without an active (valid) trace, i.e. when tracing is not enabled, no header is added.
 */
class AddTraceIdHeader {
  public function handle(Request $request, Closure $next): Response {
    /** @var Response $response */
    $response = $next($request);
    $traceId = self::currentTraceId();
    if ($traceId !== null){
      $response->headers->set('X-Trace-Id', $traceId);
    }
    return $response;
  }

  /**
   * The trace id of the active request, or null when tracing is not enabled.
   */
  public static function currentTraceId(): ?string {
    $context = Span::getCurrent()->getContext();
    return $context->isValid() ? $context->getTraceId() : null;
  }
}
