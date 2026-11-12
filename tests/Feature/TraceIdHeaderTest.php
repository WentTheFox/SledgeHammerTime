<?php

namespace Tests\Feature;

use OpenTelemetry\SDK\Trace\TracerProvider;
use Tests\TestCase;

class TraceIdHeaderTest extends TestCase {
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

  public function test_responses_carry_the_trace_id_of_the_request():void {
    $this->withActiveSpan(function ($span) {
      $this->get('/frontend/does-not-exist')->assertNotFound()->assertHeader('X-Trace-Id', $span->getContext()->getTraceId());
    });
  }

  public function test_an_ordinary_page_that_queries_the_database_still_gets_the_trace_id():void {
    $this->withActiveSpan(function ($span) {
      $this->get('/en')->assertOk()->assertHeader('X-Trace-Id', $span->getContext()->getTraceId());
    });
  }

  public function test_there_is_no_trace_id_header_without_tracing():void {
    $this->get('/frontend/does-not-exist')->assertHeaderMissing('X-Trace-Id');
  }

  public function test_no_trace_context_is_handed_to_the_browser():void {
    $this->withActiveSpan(function () {
      $this->get('/en')->assertHeaderMissing('Server-Timing');
    });
  }
}
