<?php

declare(strict_types=1);

namespace App\Services\ApiKeys;

use App\Enums\ApiKeyScope;
use App\Models\DiscordUser;
use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Support\ReadOnlyMode;
use Carbon\CarbonInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Container\Attributes\Singleton;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Laravel\Sanctum\NewAccessToken;

#[Singleton]
class ApiKeyService {
  /**
   * Makes the keys recognisable (and findable by secret scanners) when they end up somewhere they should not
   */
  public const string TOKEN_PREFIX = 'htk_';

  /**
   * Per user, so keys can not be created without limit
   */
  public const int MAX_KEYS_PER_USER = 25;

  /**
   * @param list<string> $scopes Values of {@see ApiKeyScope}
   *
   * @throws AuthorizationException When the Discord account is not linked to the user
   */
  public function create(User $user, DiscordUser $discordUser, string $name, array $scopes, ?CarbonInterface $expiresAt = null):NewAccessToken {
    if ($discordUser->user_id !== $user->id){
      throw new AuthorizationException('The Discord account is not linked to this user.');
    }
    $scopes = array_values(array_unique($scopes));
    if ($scopes === [] || array_diff($scopes, ApiKeyScope::values()) !== []){
      throw new InvalidArgumentException('An API key needs at least one valid scope.');
    }

    return DB::transaction(function () use ($user, $discordUser, $name, $scopes, $expiresAt) {
      $previousPrefix = config('sanctum.token_prefix');
      config(['sanctum.token_prefix' => self::TOKEN_PREFIX]);
      try {
        $newToken = $user->createToken($name, $scopes, $expiresAt);
      }
      finally {
        config(['sanctum.token_prefix' => $previousPrefix]);
      }
      $newToken->accessToken->forceFill(['discord_user_id' => $discordUser->id])->save();

      return $newToken;
    });
  }

  /**
   * @return Collection<int, PersonalAccessToken>
   */
  public function listFor(User $user):Collection {
    /** @var Collection<int, PersonalAccessToken> */
    return $user->tokens()->whereNotNull('discord_user_id')->latest()->get();
  }

  public function revoke(User $user, string|int $tokenId):bool {
    return $user->tokens()->whereKey($tokenId)->whereNotNull('discord_user_id')->delete() > 0;
  }

  /**
   * Looks up a key presented to the API.
   *
   * A key either acts as the one Discord account it was created for ("user"), or it is the bot's own token
   * carrying the act-as ability, which acts as whichever account the bot names ("service"). Anything else, such as
   * the bot's plain token or a key whose account was unlinked, is not a key.
   *
   * @return array{kind: 'user'|'service', discord_user_id: string|null, scopes: list<string>, key_id: string}|null
   */
  public function validate(string $plainTextToken):?array {
    /** @var PersonalAccessToken|null $token */
    $token = PersonalAccessToken::findToken($plainTextToken);
    if (!$token || ($token->expires_at && $token->expires_at->isPast())){
      return null;
    }
    $owner = $token->tokenable;
    if (!$owner instanceof User){
      return null;
    }
    $abilities = $token->abilities ?? [];

    if (in_array(ApiKeyScope::ACT_AS_DISCORD_USER, $abilities, true)){
      if ($owner->id !== config('app.console_user_uuid')){
        return null;
      }
      $key = [
        'kind' => 'service',
        'discord_user_id' => null,
        // The bot only gets to run commands, never to change settings or manage keys
        'scopes' => [ApiKeyScope::TIMESTAMPS_CREATE->value],
        'key_id' => (string)$token->getKey(),
      ];
    }
    else {
      $scopes = array_values(array_intersect($abilities, ApiKeyScope::values()));
      if ($token->discord_user_id === null || $scopes === []){
        return null;
      }
      // The account has to still belong to the user that created the key
      if (!$owner->discordUsers()->whereKey($token->discord_user_id)->exists()){
        return null;
      }
      $key = [
        'kind' => 'user',
        'discord_user_id' => $token->discord_user_id,
        'scopes' => $scopes,
        'key_id' => (string)$token->getKey(),
      ];
    }

    $this->markUsed($token);

    return $key;
  }

  private function markUsed(PersonalAccessToken $token):void {
    // A write, so not while the deploy window rejects them
    if (ReadOnlyMode::isActive()){
      return;
    }
    if ($token->last_used_at === null || $token->last_used_at->lte(now()->subMinute())){
      $token->forceFill(['last_used_at' => now()])->save();
    }
  }
}
