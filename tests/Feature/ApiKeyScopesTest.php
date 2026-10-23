<?php

namespace Tests\Feature;

use App\Enums\ApiKeyScope;
use App\Models\PersonalAccessToken;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use InvalidArgumentException;
use Tests\Support\CreatesApiFixtures;
use Tests\TestCase;

/**
 * The scopes of every kind of token there is. What a key may do is the one thing that must not drift: the keys the website hands
 * out (to the API and to MCP consumers) are limited to the three user scopes, and the internal ones (the bot's service key, its
 * plain token) can not be made, or mistaken for them, from the outside.
 */
class ApiKeyScopesTest extends TestCase {
  use DatabaseTransactions, CreatesApiFixtures;

  protected function tearDown():void {
    $this->forgetCreatedDiscordUsersSettings();
    parent::tearDown();
  }

  private function service():ApiKeyService {
    return app(ApiKeyService::class);
  }

  /**
   * @return array<string, array{0: list<string>}>
   */
  public static function userScopeCombinations():array {
    return [
      'timestamps only' => [['timestamps:create']],
      'read only' => [['settings:read']],
      'write only' => [['settings:write']],
      'timestamps and read' => [['timestamps:create', 'settings:read']],
      'everything' => [['timestamps:create', 'settings:read', 'settings:write']],
    ];
  }

  public function test_the_scopes_a_user_can_choose_are_these_three_and_never_an_internal_one():void {
    $this->assertSame(['timestamps:create', 'settings:read', 'settings:write'], ApiKeyScope::values());
    $this->assertNotContains(ApiKeyScope::ACT_AS_DISCORD_USER, ApiKeyScope::values());
    $this->assertNotContains('*', ApiKeyScope::values());
  }

  /**
   * @param list<string> $scopes
   */
  #[\PHPUnit\Framework\Attributes\DataProvider('userScopeCombinations')]
  public function test_a_key_made_on_the_website_has_exactly_the_scopes_that_were_asked_for(array $scopes):void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);

    $this->actingAs($user)->post('/api-keys', [
      'name' => 'Scoped',
      'discord_user_id' => (string)$discordUser->id,
      'scopes' => $scopes,
      'expires_in_days' => 30,
    ])->assertRedirect();

    $key = PersonalAccessToken::where('name', 'Scoped')->sole();
    $this->assertSame($scopes, $key->abilities);
    $this->assertNotContains('*', $key->abilities);
    $this->assertNotContains(ApiKeyScope::ACT_AS_DISCORD_USER, $key->abilities);
    // What the API server is told is what the key was made with, nothing more
    $token = $this->service()->create($user, $discordUser, 'Checked', $scopes);
    $this->assertSame($scopes, $this->service()->validate($token->plainTextToken)['scopes']);
    $this->assertSame('user', $this->service()->validate($token->plainTextToken)['kind']);
  }

  public function test_a_scope_is_not_kept_twice(): void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);

    $token = $this->service()->create($user, $discordUser, 'Twice', ['settings:read', 'settings:read', 'timestamps:create']);

    $this->assertSame(['settings:read', 'timestamps:create'], $token->accessToken->abilities);
  }

  public function test_no_way_of_making_a_key_for_a_user_accepts_an_internal_scope():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);

    foreach ([ApiKeyScope::ACT_AS_DISCORD_USER, '*', 'admin', ''] as $scope){
      $this->actingAs($user)->post('/api-keys', [
        'name' => 'Sneaky',
        'discord_user_id' => (string)$discordUser->id,
        'scopes' => ['timestamps:create', $scope],
        'expires_in_days' => 30,
      ])->assertSessionHasErrors('scopes.1');

      try {
        $this->service()->create($user, $discordUser, 'Sneaky', ['timestamps:create', $scope]);
        $this->fail("The service made a key with the scope \"$scope\"");
      }
      catch (InvalidArgumentException) {
        // Refused, as it should
      }
    }
    $this->assertSame(0, PersonalAccessToken::where('name', 'Sneaky')->count());
  }

  public function test_rotating_a_key_does_not_carry_an_internal_scope_over(): void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    // A key that somehow has one, made behind the service's back
    $old = $user->createToken('Odd', ['timestamps:create', ApiKeyScope::ACT_AS_DISCORD_USER, '*']);
    $old->accessToken->forceFill(['discord_user_id' => $discordUser->id])->save();

    $new = $this->service()->rotate($user, $old->accessToken->getKey());

    $this->assertNotNull($new);
    $this->assertSame(['timestamps:create'], $new->accessToken->abilities);
  }

  public function test_the_service_key_can_only_act_for_others_and_the_api_server_only_lets_it_run_commands():void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);

    $this->assertSame(0, Artisan::call('bot-token:generate', ['--service' => true]));
    preg_match('/\d+\|\w+/', Artisan::output(), $matches);

    $stored = $consoleUser->tokens()->sole();
    $this->assertSame([ApiKeyScope::ACT_AS_DISCORD_USER], $stored->abilities);
    $validated = $this->service()->validate($matches[0]);
    $this->assertSame('service', $validated['kind']);
    // Not the settings, whatever it can act as
    $this->assertSame(['timestamps:create'], $validated['scopes']);
    $this->assertNotContains('settings:read', $validated['scopes']);
    $this->assertNotContains('settings:write', $validated['scopes']);
  }

  public function test_the_plain_bot_token_has_every_ability_for_the_bots_own_endpoints_and_is_still_no_api_key():void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);

    $this->assertSame(0, Artisan::call('bot-token:generate'));
    preg_match('/\d+\|\w+/', Artisan::output(), $matches);

    $this->assertSame(['*'], $consoleUser->tokens()->sole()->abilities);
    $this->assertNull($this->service()->validate($matches[0]));
  }

  public function test_a_token_with_every_ability_is_not_a_key_even_with_an_account_attached(): void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $token = $user->createToken('Everything');
    $token->accessToken->forceFill(['discord_user_id' => $discordUser->id])->save();

    // The * of Sanctum means "all", and none of what API keys are limited to
    $this->assertNull($this->service()->validate($token->plainTextToken));
  }

  public function test_a_service_key_of_anyone_but_the_console_user_is_no_key(): void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);
    $impostor = $this->createUser('Impostor')->createToken('Service', [ApiKeyScope::ACT_AS_DISCORD_USER]);

    $this->assertNull($this->service()->validate($impostor->plainTextToken));
  }

  // --- what the tokens can reach: the bot's own endpoints are for the bot alone

  /**
   * The bot's endpoints that a token has to be the bot's to use. These two are for any token that is signed in, and give nothing
   * about anyone else: a user's own details, and the translator credits the website shows to everybody.
   */
  private const array ENDPOINTS_FOR_ANY_TOKEN = ['api/user', 'api/crowdin-translator-credits'];

  public function test_every_endpoint_of_the_bot_asks_for_its_user_and_for_an_ability_to_be_the_bot():void {
    $checked = [];
    foreach (Route::getRoutes()->getRoutes() as $route){
      if (!str_starts_with($route->uri(), 'api/') || in_array($route->uri(), self::ENDPOINTS_FOR_ANY_TOKEN, true)){
        continue;
      }
      $middleware = $route->gatherMiddleware();
      $this->assertContains('auth:sanctum', $middleware, $route->uri());
      $this->assertContains('console-user', $middleware, $route->uri().' is open to any user with a token');
      $this->assertContains('ability:'.ApiKeyScope::BOT_ENDPOINTS, $middleware, $route->uri().' is open to a token that can not be the bot');
      $checked[] = $route->uri();
    }

    // A new endpoint under /api is covered without anyone remembering to add it here, and the list is not empty by accident
    $this->assertGreaterThanOrEqual(8, count($checked));
  }

  public function test_the_bots_endpoints_do_not_open_to_a_key_made_on_the_website():void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $key = $this->service()->create($user, $discordUser, 'Mine', ApiKeyScope::values());

    $response = $this->withToken($key->plainTextToken)->getJson("/api/settings/{$discordUser->id}");

    $response->assertUnauthorized();
    // Nothing about who the bot is
    $this->assertStringNotContainsString($consoleUser->id, $response->getContent());
    $this->withToken($key->plainTextToken)->postJson('/api/command-telemetry', ['commandId' => '1', 'locale' => 'en', 'options' => []])->assertUnauthorized();
    $this->withToken($key->plainTextToken)->postJson("/api/login-link/{$discordUser->id}/en", [])->assertUnauthorized();
  }

  public function test_the_service_key_of_the_api_server_can_not_do_what_the_bot_does(): void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);
    $discordUser = $this->createDiscordUser($this->createUser());
    $serviceKey = $this->service()->createServiceKey($consoleUser);

    // It belongs to the console user, and is still not allowed to be the bot
    $this->withToken($serviceKey->plainTextToken)->getJson("/api/settings/{$discordUser->id}")->assertForbidden();
    $this->withToken($serviceKey->plainTextToken)->putJson('/api/bot-commands', [])->assertForbidden();
  }

  public function test_the_bots_plain_token_still_opens_the_endpoints_of_the_bot(): void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);
    $discordUser = $this->createDiscordUser($this->createUser());
    $botToken = $consoleUser->createToken('Bot token');

    $this->withToken($botToken->plainTextToken)->getJson("/api/settings/{$discordUser->id}")->assertOk();
  }

  public function test_the_internal_endpoints_are_not_reachable_with_any_token_alone(): void {
    $user = $this->createUser();
    $key = $this->service()->create($user, $this->createDiscordUser($user), 'Mine', ApiKeyScope::values());
    config(['services.internal_api.secret' => 'a-secret-that-the-site-and-the-api-server-share']);

    // The shared secret, sent as the bearer token, is what opens them. A key is not it, not even one that is valid as an API key,
    // and neither is a guess
    $this->withToken($key->plainTextToken)->postJson('/internal/keys/validate', ['token' => $key->plainTextToken])->assertForbidden();
    $this->withToken('a-guess')->postJson('/internal/keys/validate', ['token' => $key->plainTextToken])->assertForbidden();
    $this->postJson('/internal/keys/validate', ['token' => $key->plainTextToken])->assertForbidden();
    // The secret itself does, so the refusals above are about the credential and not about the request
    $this->withToken('a-secret-that-the-site-and-the-api-server-share')->postJson('/internal/keys/validate', ['token' => $key->plainTextToken])
      ->assertOk()->assertJson(['kind' => 'user']);
  }
}
