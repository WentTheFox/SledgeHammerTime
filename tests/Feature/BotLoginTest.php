<?php

namespace Tests\Feature;

use App\Models\DiscordUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\URL;
use Tests\Support\CreatesApiFixtures;
use Tests\TestCase;

/**
 * The login links the bot gives out with its /settings command: the bot asks for one with its own token,
 * and whoever opens it is logged in as the Discord account it names.
 */
class BotLoginTest extends TestCase {
  use DatabaseTransactions, CreatesApiFixtures;

  private const array ACCOUNT = ['name' => 'tester', 'display_name' => 'Tester', 'discriminator' => 0];

  protected function tearDown():void {
    $this->forgetCreatedDiscordUsersSettings();
    parent::tearDown();
  }

  /**
   * @param array<string, mixed> $parameters
   */
  private function signedLink(int $discordUserId, array $parameters = self::ACCOUNT, string $expiresIn = '+5 minutes'):string {
    return URL::temporarySignedRoute('botLogin', now()->modify($expiresIn), [
      'discordUserId' => $discordUserId,
      'locale' => 'en',
      ...$parameters,
    ]);
  }

  public function test_a_visitor_with_a_valid_link_is_logged_in_as_the_account():void {
    $discordUserId = random_int(100_000_000_000_000_000, 900_000_000_000_000_000);

    $this->get($this->signedLink($discordUserId))->assertRedirect(route('settings', ['locale' => 'en']));

    $discordUser = DiscordUser::findOrFail($discordUserId);
    $this->assertSame('tester', $discordUser->name);
    $this->assertNotNull($discordUser->user_id, 'A first login creates the website account');
    $this->assertAuthenticatedAs($discordUser->user);
  }

  public function test_a_linked_account_logs_in_as_its_existing_user():void {
    $user = $this->createUser('Existing');
    $discordUser = $this->createDiscordUser($user);

    $this->get($this->signedLink($discordUser->id))->assertRedirect();

    $this->assertAuthenticatedAs($user);
    $this->assertSame($user->id, $discordUser->fresh()->user_id);
  }

  public function test_it_refuses_links_that_were_tampered_with_or_expired_or_unsigned():void {
    $discordUserId = random_int(100_000_000_000_000_000, 900_000_000_000_000_000);
    $link = $this->signedLink($discordUserId);

    $this->get(str_replace('name=tester', 'name=admin', $link))->assertUnauthorized();
    $this->get($this->signedLink($discordUserId, expiresIn: '-1 minute'))->assertUnauthorized();
    $this->get(route('botLogin', ['discordUserId' => $discordUserId, 'locale' => 'en', ...self::ACCOUNT]))->assertUnauthorized();

    $this->assertGuest();
    $this->assertNull(DiscordUser::find($discordUserId), 'No account is created by a refused link');
  }

  public function test_the_bot_can_create_a_link_that_a_visitor_can_open():void {
    $consoleUser = $this->createUser('Console');
    config(['app.console_user_uuid' => $consoleUser->id]);
    $discordUserId = random_int(100_000_000_000_000_000, 900_000_000_000_000_000);

    $response = $this->withToken($consoleUser->createToken('Bot token')->plainTextToken)
      ->postJson("/api/login-link/$discordUserId/en", self::ACCOUNT)
      ->assertOk()
      ->assertJsonStructure(['loginUrl', 'expiresAt']);

    // Whoever opens it is a visitor, not the bot: separate requests in production, so drop what the first one set up
    $this->app['auth']->forgetGuards();
    $this->app['auth']->shouldUse('web');
    $this->withToken('')->get($response->json('loginUrl'))->assertRedirect(route('settings', ['locale' => 'en']));
    $this->assertSame((string)$discordUserId, (string)DiscordUser::findOrFail($discordUserId)->id);
  }

  public function test_only_the_bot_can_create_a_link():void {
    config(['app.console_user_uuid' => $this->createUser('Console')->id]);
    $someoneElse = $this->createUser('Someone else');

    $this->withToken($someoneElse->createToken('Not the bot')->plainTextToken)
      ->postJson('/api/login-link/123456789/en', self::ACCOUNT)
      ->assertUnauthorized();
    $this->postJson('/api/login-link/123456789/en', self::ACCOUNT)->assertUnauthorized();
  }
}
