<?php

namespace Tests\Feature;

use App\Enums\ApiKeyScope;
use App\Models\Settings;
use App\Models\TelemetryCommandExecution;
use App\Models\User;
use App\Services\ApiKeys\ApiKeyService;
use App\Services\Discord\DiscordUserService;
use App\Support\ReadOnlyMode;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use Tests\Support\CreatesApiFixtures;
use Tests\TestCase;

class InternalApiTest extends TestCase {
  use DatabaseTransactions, CreatesApiFixtures;

  private const string SECRET = 'internal-test-secret-0123456789';

  protected function setUp():void {
    parent::setUp();
    config(['services.internal_api.secret' => self::SECRET]);
    ReadOnlyMode::disable();
  }

  protected function tearDown():void {
    ReadOnlyMode::disable();
    $this->forgetCreatedDiscordUsersSettings();
    parent::tearDown();
  }

  private function internal():static {
    return $this->withToken(self::SECRET)->withHeader('Accept', 'application/json');
  }

  public function test_it_rejects_requests_without_the_shared_secret():void {
    $this->postJson('/internal/keys/validate', ['token' => 'x'])->assertUnauthorized();
    $this->withToken('wrong-secret')->postJson('/internal/keys/validate', ['token' => 'x'])->assertUnauthorized();
    $this->withToken('wrong-secret')->getJson('/internal/settings/1')->assertUnauthorized();
  }

  public function test_it_refuses_to_run_without_a_configured_secret():void {
    config(['services.internal_api.secret' => null]);

    $this->withToken('anything')->getJson('/internal/settings/1')->assertStatus(500);
  }

  public function test_it_is_not_throttled_like_the_public_api():void {
    for ($i = 0; $i < 70; $i++){
      $this->internal()->getJson('/internal/settings/1')->assertOk();
    }
  }

  // --- keys

  public function test_it_validates_a_user_key():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $newToken = app(ApiKeyService::class)->create($user, $discordUser, 'My key', [ApiKeyScope::TIMESTAMPS_CREATE->value, ApiKeyScope::SETTINGS_READ->value]);

    $response = $this->internal()->postJson('/internal/keys/validate', ['token' => $newToken->plainTextToken]);

    $response->assertOk()->assertExactJson([
      'kind' => 'user',
      'discord_user_id' => (string)$discordUser->id,
      'scopes' => ['timestamps:create', 'settings:read'],
      'key_id' => (string)$newToken->accessToken->getKey(),
    ]);
    $this->assertStringContainsString('|htk_', $newToken->plainTextToken);
    $this->assertNotNull($newToken->accessToken->fresh()->last_used_at);
  }

  public function test_it_rejects_unknown_expired_and_revoked_keys():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $service = app(ApiKeyService::class);
    $expired = $service->create($user, $discordUser, 'Old', [ApiKeyScope::TIMESTAMPS_CREATE->value], Carbon::now()->subMinute());
    $revoked = $service->create($user, $discordUser, 'Revoked', [ApiKeyScope::TIMESTAMPS_CREATE->value]);
    $service->revoke($user, $revoked->accessToken->getKey());

    foreach (['1|nonsense', 'nonsense', $expired->plainTextToken, $revoked->plainTextToken] as $token){
      $this->internal()->postJson('/internal/keys/validate', ['token' => $token])->assertUnauthorized();
    }
    $this->internal()->postJson('/internal/keys/validate', [])->assertUnprocessable();
  }

  public function test_it_does_not_accept_the_bots_plain_token_as_a_key():void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);
    $botToken = $consoleUser->createToken('Bot token');

    $this->internal()->postJson('/internal/keys/validate', ['token' => $botToken->plainTextToken])->assertUnauthorized();
  }

  public function test_it_stops_accepting_a_key_whose_account_was_unlinked():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $newToken = app(ApiKeyService::class)->create($user, $discordUser, 'Key', [ApiKeyScope::SETTINGS_READ->value]);
    $discordUser->forceFill(['user_id' => $this->createUser('Someone else')->id])->save();

    $this->internal()->postJson('/internal/keys/validate', ['token' => $newToken->plainTextToken])->assertUnauthorized();
  }

  public function test_it_validates_the_service_key_of_the_console_user_only():void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);
    $serviceToken = $consoleUser->createToken('Service', [ApiKeyScope::ACT_AS_DISCORD_USER]);
    $impostor = $this->createUser('Impostor')->createToken('Service', [ApiKeyScope::ACT_AS_DISCORD_USER]);

    $this->internal()->postJson('/internal/keys/validate', ['token' => $serviceToken->plainTextToken])
      ->assertOk()
      ->assertJson(['kind' => 'service', 'discord_user_id' => null, 'scopes' => ['timestamps:create']]);
    $this->internal()->postJson('/internal/keys/validate', ['token' => $impostor->plainTextToken])->assertUnauthorized();
  }

  public function test_it_will_not_create_a_key_for_an_account_of_someone_else():void {
    $this->expectException(\Illuminate\Auth\Access\AuthorizationException::class);

    app(ApiKeyService::class)->create($this->createUser(), $this->createDiscordUser($this->createUser('Other')), 'Key', [ApiKeyScope::SETTINGS_READ->value]);
  }

  public function test_it_will_not_create_a_key_without_valid_scopes():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);

    foreach ([[], ['everything']] as $scopes){
      try {
        app(ApiKeyService::class)->create($user, $discordUser, 'Key', $scopes);
        $this->fail('Expected an InvalidArgumentException');
      }
      catch (\InvalidArgumentException) {
        $this->addToAssertionCount(1);
      }
    }
  }

  public function test_it_only_lists_and_revokes_api_keys_of_the_user():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $service = app(ApiKeyService::class);
    $key = $service->create($user, $discordUser, 'Key', [ApiKeyScope::SETTINGS_READ->value]);
    $plain = $user->createToken('Not an API key');

    $this->assertSame([$key->accessToken->getKey()], $service->listFor($user)->modelKeys());
    $this->assertFalse($service->revoke($user, $plain->accessToken->getKey()));
    $this->assertFalse($service->revoke($this->createUser('Other'), $key->accessToken->getKey()));
    $this->assertTrue($service->revoke($user, $key->accessToken->getKey()));
  }

  // --- settings

  public function test_it_returns_defaults_for_an_account_that_never_customised_anything():void {
    $response = $this->internal()->getJson('/internal/settings/'.random_int(100_000_000_000_000_000, 900_000_000_000_000_000));

    $response->assertOk()->assertExactJson(Settings::mergeWithDefaults([]));
    $this->assertSame('GMT', $response->json('timezone'));
    $this->assertTrue($response->json('telemetry'));
    $this->assertNull($response->json('format'));
  }

  public function test_it_changes_only_the_given_settings_and_resets_with_null():void {
    $discordUser = $this->createDiscordUser($this->createUser());
    $uri = "/internal/settings/$discordUser->id";

    $this->internal()->patchJson($uri, ['timezone' => 'GMT+2', 'defaultAtHour' => 7, 'format' => 'R'])
      ->assertOk()
      ->assertJson(['timezone' => 'GMT+02:00', 'defaultAtHour' => 7, 'format' => 'R', 'header' => true]);

    // Untouched settings survive, a null resets one to its default
    $this->internal()->patchJson($uri, ['telemetry' => false, 'timezone' => null])
      ->assertOk()
      ->assertJson(['timezone' => 'GMT', 'defaultAtHour' => 7, 'format' => 'R', 'telemetry' => false]);

    $this->assertEqualsCanonicalizing(['defaultAtHour', 'format', 'telemetry'], $discordUser->settings()->pluck('setting')->all());
  }

  public function test_it_clears_the_cached_settings_after_a_change():void {
    $discordUser = $this->createDiscordUser($this->createUser());
    $uri = "/internal/settings/$discordUser->id";
    $this->internal()->getJson($uri)->assertJson(['defaultAtMinute' => null]);

    $this->internal()->patchJson($uri, ['defaultAtMinute' => 30])->assertOk();

    // This is what the bot reads, and it is served from the cache for five minutes
    $this->assertSame(30, app(DiscordUserService::class)->getSettingsWithDefaults($discordUser->id)['defaultAtMinute']);
    $this->internal()->getJson($uri)->assertJson(['defaultAtMinute' => 30]);
  }

  public function test_it_validates_setting_values_like_the_settings_page():void {
    $discordUser = $this->createDiscordUser($this->createUser());

    $this->internal()->patchJson("/internal/settings/$discordUser->id", ['timezone' => 'Nowhere/Land', 'defaultAtHour' => 24, 'columns' => 'sideways'])
      ->assertUnprocessable()
      ->assertJsonValidationErrors(['timezone', 'defaultAtHour', 'columns']);
    $this->assertSame(0, $discordUser->settings()->count());
  }

  public function test_it_does_not_patch_the_settings_of_an_unknown_account():void {
    $this->internal()->patchJson('/internal/settings/'.random_int(100_000_000_000_000_000, 900_000_000_000_000_000), ['header' => false])->assertNotFound();
  }

  // --- telemetry

  public function test_it_records_a_run_by_command_name_and_counts_all_sources():void {
    $command = $this->createBotCommand('testcmd', ['hour', 'minute']);
    $command->telemetryExecutions()->create(['source' => 'discord-bot']);

    $response = $this->internal()->postJson('/internal/command-telemetry', [
      'commandName' => 'testcmd',
      'locale' => 'en-US',
      'source' => 'api',
      'options' => [['name' => 'hour', 'type' => 3], ['name' => 'unknown', 'type' => 3]],
    ]);

    $response->assertOk()->assertJson([
      'executionNumber' => 2,
      'commandName' => 'testcmd',
      'commandId' => (string)$command->id,
    ]);
    $this->assertStringEndsWith('#telemetry-statistics', $response->json('privacyPolicyUrl'));
    $this->assertSame(['discord-bot', 'api'], $command->telemetryExecutions()->orderBy('created_at')->pluck('source')->all());
    $this->assertSame(1, $command->options()->where('name', 'hour')->first()->telemetryUses()->count());
    $this->assertSame(0, $command->options()->where('name', 'minute')->first()->telemetryUses()->count());
  }

  public function test_it_rejects_telemetry_for_unknown_commands_and_sources():void {
    $this->createBotCommand();

    $this->internal()->postJson('/internal/command-telemetry', ['commandName' => 'nope', 'locale' => 'en', 'source' => 'api'])->assertNotFound();
    $this->internal()->postJson('/internal/command-telemetry', ['commandName' => 'testcmd', 'locale' => 'en', 'source' => 'carrier-pigeon'])
      ->assertUnprocessable()
      ->assertJsonValidationErrors(['source']);
  }

  public function test_the_bots_own_telemetry_endpoint_still_works_and_is_recorded_as_the_bot():void {
    $command = $this->createBotCommand('testcmd', ['hour']);
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);

    $this->withToken($consoleUser->createToken('Bot token')->plainTextToken)
      ->postJson('/api/command-telemetry', ['commandId' => $command->id, 'locale' => 'en-US', 'options' => [['name' => 'hour']]])
      ->assertOk()
      ->assertJson(['executionNumber' => 1, 'commandName' => 'testcmd']);

    $this->assertSame('discord-bot', TelemetryCommandExecution::where('bot_command_id', $command->id)->value('source'));
  }

  public function test_the_bots_telemetry_endpoint_reports_an_unknown_command_instead_of_crashing():void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);

    $this->withToken($consoleUser->createToken('Bot token')->plainTextToken)
      ->postJson('/api/command-telemetry', ['commandId' => 1, 'locale' => 'en-US', 'options' => [['name' => 'hour']]])
      ->assertNotFound();
  }

  // --- the deploy window

  public function test_it_keeps_validating_keys_but_rejects_writes_while_read_only():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $newToken = app(ApiKeyService::class)->create($user, $discordUser, 'Key', [ApiKeyScope::SETTINGS_READ->value]);
    $this->createBotCommand();
    ReadOnlyMode::enable();

    $this->internal()->postJson('/internal/keys/validate', ['token' => $newToken->plainTextToken])->assertOk();
    $this->assertNull($newToken->accessToken->fresh()->last_used_at, 'No write while read-only, not even last_used_at');
    $this->internal()->getJson("/internal/settings/$discordUser->id")->assertOk();
    $this->internal()->patchJson("/internal/settings/$discordUser->id", ['header' => false])->assertStatus(503)->assertHeader('Retry-After');
    $this->internal()->postJson('/internal/command-telemetry', ['commandName' => 'testcmd', 'locale' => 'en', 'source' => 'api'])->assertStatus(503);
  }

  public function test_the_user_model_is_still_a_sanctum_token_holder():void {
    $this->assertInstanceOf(\App\Models\PersonalAccessToken::class, $this->createUser()->createToken('x')->accessToken);
    $this->assertInstanceOf(User::class, $this->createUser());
  }
}
