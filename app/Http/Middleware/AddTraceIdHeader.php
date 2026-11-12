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
    $context = Span::getCurrent()->getContext();
    if ($context->isValid()){
      $response->headers->set('X-Trace-Id', $context->getTraceId());
    }
    return $response;
  }
}
