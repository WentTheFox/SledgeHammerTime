<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use OpenTelemetry\SDK\Trace\TracerProvider;
use Tests\TestCase;

class EndUserSpanAttributeTest extends TestCase {
  use DatabaseTransactions;

  /** @return array<string, mixed> */
  private function attributesAfter(callable $request):array {
    $span = (new TracerProvider())->getTracer('test')->spanBuilder('test')->startSpan();
    $scope = $span->activate();
    try {
      $request();
      return $span->toSpanData()->getAttributes()->toArray();
    } finally {
      $scope->detach();
      $span->end();
    }
  }

  public function test_a_logged_in_request_is_marked_without_saying_who():void {
    $user = User::factory()->create();

    $attributes = $this->attributesAfter(fn() => $this->actingAs($user)->withSession([])->getJson('/frontend/user-info')->assertOk());

    $this->assertTrue($attributes['app.user.logged_in'] ?? false);
    $this->assertArrayNotHasKey('enduser.id', $attributes);
    $this->assertStringNotContainsString($user->id, json_encode($attributes));
  }

  public function test_guests_are_not_marked():void {
    $attributes = $this->attributesAfter(fn() => $this->getJson('/frontend/user-info'));

    $this->assertArrayNotHasKey('app.user.logged_in', $attributes);
  }
}
