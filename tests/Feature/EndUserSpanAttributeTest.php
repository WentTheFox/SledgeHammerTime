<?php

namespace Tests\Feature;

use App\Models\DiscordUser;
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

  public function test_the_discord_user_id_of_a_logged_in_user_is_on_the_span():void {
    $user = User::factory()->create();
    DiscordUser::create(['id' => '123456789012345678', 'name' => 'x', 'discriminator' => '0', 'user_id' => $user->id]);

    $attributes = $this->attributesAfter(fn() => $this->actingAs($user)->getJson('/frontend/user-info')->assertOk());

    $this->assertSame('123456789012345678', $attributes['enduser.id'] ?? null);
  }

  public function test_guests_get_no_end_user_attribute():void {
    $attributes = $this->attributesAfter(fn() => $this->getJson('/frontend/user-info'));

    $this->assertArrayNotHasKey('enduser.id', $attributes);
  }
}
