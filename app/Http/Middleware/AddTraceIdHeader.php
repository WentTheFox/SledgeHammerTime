<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenTelemetry\API\Trace\Span;
use OpenTelemetry\API\Trace\SpanContextInterface;
use OpenTelemetry\API\Trace\SpanInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Exposes the OpenTelemetry trace id of the current request as `X-Trace-Id`, so a user can quote it in a bug report.
 * Without an active (valid) trace, i.e. when tracing is not enabled, no header is added.
 */
class AddTraceIdHeader {
  private const SPAN_ATTRIBUTE = 'otel.request_span';

  public function handle(Request $request, Closure $next): Response {
    // Taken before the request is handled: the active span is not reliable afterwards, instrumentation of the code that
    // handles the request (database queries) can leave the context without it by the time the response is returned
    $span = Span::getCurrent();
    $request->attributes->set(self::SPAN_ATTRIBUTE, $span);

    /** @var Response $response */
    $response = $next($request);
    $context = $span->getContext();
    if ($context->isValid()){
      $this->markLoggedInUser($request, $span);
      $response->headers->set('X-Trace-Id', $context->getTraceId());
      if (config('app.browser_tracing.enabled') && str_contains((string) $response->headers->get('Content-Type'), 'text/html')){
        $this->addServerTimingTraceparent($response, $context);
      }
    }
    return $response;
  }

  /**
   * The trace id of the current request, or null when tracing is not enabled for it.
   */
  public static function currentTraceId(): ?string {
    $requestSpan = request()->attributes->get(self::SPAN_ATTRIBUTE);
    $context = ($requestSpan instanceof SpanInterface ? $requestSpan : Span::getCurrent())->getContext();

    return $context->isValid() ? $context->getTraceId() : null;
  }

  /**
   * Gives the browser the trace context of this page request, for its page load spans to join the server trace. It is
   * a header and not a <meta> tag in the HTML, as the HTML is cached and would carry the trace id of another request.
   * The frontend reads it from the navigation timing (same origin, so no Timing-Allow-Origin is needed).
   */
  private function addServerTimingTraceparent(Response $response, SpanContextInterface $context): void {
    $traceparent = sprintf('00-%s-%s-%02x', $context->getTraceId(), $context->getSpanId(), $context->getTraceFlags());
    $existing = $response->headers->get('Server-Timing');
    $entry = sprintf('traceparent;desc="%s"', $traceparent);
    $response->headers->set('Server-Timing', $existing ? "$existing, $entry" : $entry);
  }

  /**
   * Marks the request span as made by a logged in user (`app.user.logged_in`), and nothing about who: that is enough to
   * tell such requests apart, and users report a failed request with the trace id they are shown. Read from the session
   * and the token, so nothing is looked up in the database.
   */
  private function markLoggedInUser(Request $request, SpanInterface $span): void {
    if (!$span->isRecording()){
      return;
    }
    $sessionLoggedIn = Auth::guard('web')->hasUser()
      || ($request->hasSession() && $request->session()->has(Auth::guard('web')->getName()));
    $tokenLoggedIn = config('auth.guards.sanctum') !== null && Auth::guard('sanctum')->hasUser();
    if ($sessionLoggedIn || $tokenLoggedIn){
      $span->setAttribute('app.user.logged_in', true);
    }
  }
}
