<?php

namespace Tests\Feature;

use OpenTelemetry\SDK\Trace\TracerProvider;
use Tests\TestCase;

class ServerTimingTraceparentTest extends TestCase {
  private function withActiveSpan(callable $callback):void {
    $span = (new TracerProvider())->getTracer('test')->spanBuilder('test')->startSpan();
    $scope = $span->activate();
    try {
      $callback($span);
    } finally {
      $scope->detach();
      $span->end();
    }
  }

  public function test_html_responses_carry_the_trace_context_for_the_browser():void {
    config(['app.browser_tracing.enabled' => true]);
    $this->withActiveSpan(function ($span) {
      $response = $this->get('/frontend/does-not-exist');
      $header = $response->headers->get('Server-Timing');
      $this->assertMatchesRegularExpression('/^traceparent;desc="00-'.$span->getContext()->getTraceId().'-[0-9a-f]{16}-0[0-3]"$/', (string) $header);
    });
  }

  public function test_no_server_timing_when_browser_tracing_is_off():void {
    $this->withActiveSpan(function () {
      $this->get('/frontend/does-not-exist')->assertHeader('X-Trace-Id')->assertHeaderMissing('Server-Timing');
    });
  }

  public function test_the_shared_props_have_no_browser_tracing_by_default():void {
    $this->assertFalse((bool) config('app.browser_tracing.enabled'));
  }
}
