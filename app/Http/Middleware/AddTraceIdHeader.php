<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
      $this->setEndUser();
      $response->headers->set('X-Trace-Id', $traceId);
      if (config('app.browser_tracing.enabled') && str_contains((string) $response->headers->get('Content-Type'), 'text/html')){
        $this->addServerTimingTraceparent($response);
      }
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

  /**
   * Gives the browser the trace context of this page request, for its page load spans to join the server trace. It is
   * a header and not a <meta> tag in the HTML, as the HTML is cached and would carry the trace id of another request.
   * The frontend reads it from the navigation timing (same origin, so no Timing-Allow-Origin is needed).
   */
  private function addServerTimingTraceparent(Response $response): void {
    $context = Span::getCurrent()->getContext();
    $traceparent = sprintf('00-%s-%s-%02x', $context->getTraceId(), $context->getSpanId(), $context->getTraceFlags());
    $existing = $response->headers->get('Server-Timing');
    $entry = sprintf('traceparent;desc="%s"', $traceparent);
    $response->headers->set('Server-Timing', $existing ? "$existing, $entry" : $entry);
  }

  /**
   * Adds the Discord user ID(s) of the logged in user to the request span as `enduser.id` (the user's own decision, it
   * is listed in the privacy policy). Only when the request already resolved the user: nothing is looked up for guests
   * or for cached pages, which deliberately never touch the user.
   */
  private function setEndUser(): void {
    $span = Span::getCurrent();
    if (!$span->isRecording()){
      return;
    }
    foreach (['web', 'sanctum'] as $guardName){
      if (config("auth.guards.$guardName") === null || !Auth::guard($guardName)->hasUser()){
        continue;
      }
      $user = Auth::guard($guardName)->user();
      if (!$user instanceof User){
        continue;
      }
      $discordIds = $user->discordUsers()->orderBy('id')->pluck('id')->map(fn($id) => (string) $id)->all();
      if ($discordIds !== []){
        $span->setAttribute('enduser.id', implode(',', $discordIds));
      }

      return;
    }
  }
}
