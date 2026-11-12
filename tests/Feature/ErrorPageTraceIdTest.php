<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use OpenTelemetry\SDK\Trace\TracerProvider;
use Tests\TestCase;

class ErrorPageTraceIdTest extends TestCase {
  protected function setUp():void {
    parent::setUp();
    Route::get('/test-forbidden', fn() => abort(403));
  }

  public function test_default_error_page_has_no_trace_id_without_tracing():void {
    $this->get('/test-forbidden')->assertForbidden()->assertDontSee('Trace ID');
  }

  public function test_default_error_page_shows_the_active_trace_id():void {
    $span = (new TracerProvider())->getTracer('test')->spanBuilder('test')->startSpan();
    $scope = $span->activate();
    try {
      $this->get('/test-forbidden')->assertForbidden()->assertSee('Trace ID')->assertSee($span->getContext()->getTraceId());
    } finally {
      $scope->detach();
      $span->end();
    }
  }
}
