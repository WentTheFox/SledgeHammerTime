<?php

namespace Tests\Feature;

use App\Enums\ApiKeyScope;
use App\Models\PersonalAccessToken;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Support\CreatesApiFixtures;
use Tests\TestCase;

class ApiKeyManagementTest extends TestCase {
  use DatabaseTransactions, CreatesApiFixtures;

  protected function setUp():void {
    parent::setUp();
    // The profile page refreshes the info of Discord accounts that look stale, which must not reach Discord from a test
    Queue::fake();
  }

  protected function tearDown():void {
    $this->forgetCreatedDiscordUsersSettings();
    parent::tearDown();
  }

  /**
   * @param array<string, mixed> $overrides
   *
   * @return array<string, mixed>
   */
  private function validPayload(string|int $discordUserId, array $overrides = []):array {
    return [
      'name' => 'My script',
      'discord_user_id' => (string)$discordUserId,
      'scopes' => ['timestamps:create', 'settings:read'],
      'expires_in_days' => 30,
      ...$overrides,
    ];
  }

  /**
   * @return array<string, mixed> The Inertia page object embedded in the HTML
   */
  private function pageData(TestResponse $response):array {
    preg_match('#<script data-page="app" type="application/json">(.*?)</script>#s', $response->getContent(), $matches);

    return json_decode($matches[1], true, flags: JSON_THROW_ON_ERROR);
  }

  private function profileUri():string {
    return route('profile.edit', ['locale' => 'en']);
  }

  public function test_guests_can_not_manage_keys():void {
    $this->post('/api-keys', [])->assertRedirect();
    $this->delete('/api-keys/1')->assertRedirect();
    $this->assertSame(0, PersonalAccessToken::whereNotNull('discord_user_id')->where('name', 'My script')->count());
  }

  public function test_it_creates_a_key_for_a_linked_account_and_shows_it_once():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);

    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id))->assertRedirect($this->profileUri());

    $key = PersonalAccessToken::where('name', 'My script')->firstOrFail();
    $this->assertSame((string)$discordUser->id, $key->discord_user_id);
    $this->assertSame(['timestamps:create', 'settings:read'], $key->abilities);
    $this->assertTrue($key->expires_at->between(now()->addDays(29), now()->addDays(31)));

    // The only time the plaintext key is shown, and it is a working key
    $response = $this->actingAs($user)->get($this->profileUri());
    $response->assertInertia(fn(Assert $page) => $page->hasFlash('newApiKey.name', 'My script')->hasFlash('newApiKey.token'));
    $token = $this->pageData($response)['flash']['newApiKey']['token'];
    $this->assertMatchesRegularExpression('/^\d+\|htk_/', $token);
    $this->assertNotNull(app(ApiKeyService::class)->validate($token));
    $this->assertNotSame($token, $key->token, 'Only a hash is stored');

    $this->actingAs($user)->get($this->profileUri())->assertInertia(fn(Assert $page) => $page->missingFlash('newApiKey'));
  }

  public function test_a_key_without_an_expiry_never_expires():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);

    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id, ['expires_in_days' => null]))->assertRedirect();

    $this->assertNull(PersonalAccessToken::where('name', 'My script')->firstOrFail()->expires_at);
  }

  public function test_it_will_not_create_a_key_for_an_account_that_is_not_linked_to_the_user():void {
    $user = $this->createUser();
    $someoneElsesAccount = $this->createDiscordUser($this->createUser('Someone else'));
    $unlinkedAccount = $this->createDiscordUser();

    foreach ([$someoneElsesAccount, $unlinkedAccount] as $discordUser){
      $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id))->assertSessionHasErrors('discord_user_id');
    }
    $this->assertSame(0, PersonalAccessToken::where('name', 'My script')->count());
  }

  public function test_it_validates_the_other_fields():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);

    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id, ['name' => '']))->assertSessionHasErrors('name');
    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id, ['name' => str_repeat('a', 65)]))->assertSessionHasErrors('name');
    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id, ['scopes' => []]))->assertSessionHasErrors('scopes');
    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id, ['scopes' => ['everything']]))->assertSessionHasErrors('scopes.0');
    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id, ['scopes' => [ApiKeyScope::ACT_AS_DISCORD_USER]]))->assertSessionHasErrors('scopes.0');
    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id, ['expires_in_days' => 7]))->assertSessionHasErrors('expires_in_days');
    $this->assertSame(0, PersonalAccessToken::where('name', 'My script')->count());
  }

  public function test_it_limits_how_many_keys_a_user_can_have():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $service = app(ApiKeyService::class);
    for ($i = 0; $i < ApiKeyService::MAX_KEYS_PER_USER; $i++){
      $service->create($user, $discordUser, "Key $i", [ApiKeyScope::SETTINGS_READ->value]);
    }

    $this->actingAs($user)->post('/api-keys', $this->validPayload($discordUser->id))->assertSessionHasErrors('name');
    $this->assertSame(ApiKeyService::MAX_KEYS_PER_USER, $user->tokens()->count());
  }

  public function test_it_lists_only_the_api_keys_of_the_user_without_any_secret():void {
    $user = $this->createUser();
    $discordUser = $this->createDiscordUser($user);
    $key = app(ApiKeyService::class)->create($user, $discordUser, 'Listed', [ApiKeyScope::TIMESTAMPS_CREATE->value]);
    $user->createToken('Not an API key');
    $other = $this->createUser('Other');
    app(ApiKeyService::class)->create($other, $this->createDiscordUser($other), 'Not mine', [ApiKeyScope::SETTINGS_READ->value]);

    $this->actingAs($user)->get($this->profileUri())->assertInertia(fn(Assert $page) => $page
      ->has('apiKeys', 1)
      ->where('apiKeys.0.id', (string)$key->accessToken->getKey())
      ->where('apiKeys.0.name', 'Listed')
      ->where('apiKeys.0.discordUserId', (string)$discordUser->id)
      ->where('apiKeys.0.scopes', ['timestamps:create'])
      ->has('apiKeys.0.createdAt')
      ->missing('apiKeys.0.token')
      ->where('apiKeyScopes', ApiKeyScope::values())
      ->where('maxApiKeys', ApiKeyService::MAX_KEYS_PER_USER)
    );
  }

  public function test_it_revokes_a_key_of_the_user():void {
    $user = $this->createUser();
    $key = app(ApiKeyService::class)->create($user, $this->createDiscordUser($user), 'Doomed', [ApiKeyScope::SETTINGS_READ->value]);

    $this->actingAs($user)->delete('/api-keys/'.$key->accessToken->getKey())->assertRedirect($this->profileUri());

    $this->assertNull(app(ApiKeyService::class)->validate($key->plainTextToken));
    $this->assertSame(0, $user->tokens()->count());
  }

  public function test_it_will_not_revoke_the_key_of_someone_else_or_a_token_that_is_not_an_api_key():void {
    $owner = $this->createUser('Owner');
    $key = app(ApiKeyService::class)->create($owner, $this->createDiscordUser($owner), 'Safe', [ApiKeyScope::SETTINGS_READ->value]);
    $plain = $owner->createToken('Not an API key');
    $attacker = $this->createUser('Attacker');

    $this->actingAs($attacker)->delete('/api-keys/'.$key->accessToken->getKey())->assertNotFound();
    $this->actingAs($owner)->delete('/api-keys/'.$plain->accessToken->getKey())->assertNotFound();
    $this->assertSame(2, $owner->tokens()->count());
  }
}
