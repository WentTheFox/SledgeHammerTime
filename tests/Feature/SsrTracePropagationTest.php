<?php

namespace Tests\Feature;

use Inertia\Ssr\HttpGateway;
use OpenTelemetry\SDK\Trace\TracerProvider;
use ReflectionMethod;
use ReflectionProperty;
use Tests\TestCase;

class SsrTracePropagationTest extends TestCase {
  private function ssrRequestHeaders():array {
    $gateway = app(HttpGateway::class);
    $request = (new ReflectionMethod($gateway, 'pendingRequest'))->invoke($gateway);

    return (new ReflectionProperty($request, 'options'))->getValue($request)['headers'] ?? [];
  }

  public function test_the_ssr_request_carries_the_active_trace_context():void {
    $span = (new TracerProvider())->getTracer('test')->spanBuilder('test')->startSpan();
    $scope = $span->activate();
    try {
      $this->assertStringContainsString($span->getContext()->getTraceId(), $this->ssrRequestHeaders()['traceparent'] ?? '');
    } finally {
      $scope->detach();
      $span->end();
    }
  }

  public function test_the_ssr_request_has_no_traceparent_without_tracing():void {
    $this->assertArrayNotHasKey('traceparent', $this->ssrRequestHeaders());
  }
}
