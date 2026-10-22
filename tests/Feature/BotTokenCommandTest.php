<?php

namespace Tests\Feature;

use App\Enums\ApiKeyScope;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\Support\CreatesApiFixtures;
use Tests\TestCase;

class BotTokenCommandTest extends TestCase {
  use DatabaseTransactions, CreatesApiFixtures;

  private function consoleUserId():string {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);

    return $consoleUser->id;
  }

  private function tokenFromOutput():string {
    // The output can only be read once
    $output = Artisan::output();
    $this->assertMatchesRegularExpression('/\d+\|\w+/', $output);
    preg_match('/\d+\|\w+/', $output, $matches);

    return $matches[0];
  }

  public function test_it_creates_the_bots_plain_token_as_before():void {
    $consoleUserId = $this->consoleUserId();

    $this->assertSame(0, Artisan::call('bot-token:generate'));

    $token = $this->tokenFromOutput();
    $stored = \App\Models\User::findOrFail($consoleUserId)->tokens()->firstOrFail();
    $this->assertSame('Bot token', $stored->name);
    $this->assertSame(['*'], $stored->abilities);
    $this->assertNull(app(ApiKeyService::class)->validate($token), 'The plain token is not an API key');
  }

  public function test_it_creates_the_service_key_the_api_server_accepts():void {
    $consoleUserId = $this->consoleUserId();

    $this->assertSame(0, Artisan::call('bot-token:generate', ['--service' => true]));

    $token = $this->tokenFromOutput();
    $stored = \App\Models\User::findOrFail($consoleUserId)->tokens()->firstOrFail();
    $this->assertSame('Bot service key', $stored->name);
    $this->assertSame([ApiKeyScope::ACT_AS_DISCORD_USER], $stored->abilities);
    $this->assertStringContainsString('|htk_', $token);
    $this->assertSame(
      ['kind' => 'service', 'discord_user_id' => null, 'scopes' => ['timestamps:create'], 'key_id' => (string)$stored->getKey()],
      app(ApiKeyService::class)->validate($token),
    );
  }

  public function test_only_the_console_user_can_have_a_service_key():void {
    $this->consoleUserId();

    $this->expectException(AuthorizationException::class);

    app(ApiKeyService::class)->createServiceKey($this->createUser('Someone else'));
  }
}
