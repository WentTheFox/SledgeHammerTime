<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenTelemetry\API\Trace\Span;
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
