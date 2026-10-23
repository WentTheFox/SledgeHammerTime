<?php

namespace App\Enums;

/**
 * What an API key may do. They are stored as the abilities of the Sanctum token.
 */
enum ApiKeyScope: string {
  case TIMESTAMPS_CREATE = "timestamps:create";
  case SETTINGS_READ = "settings:read";
  case SETTINGS_WRITE = "settings:write";

  /**
   * The ability that the bot's own endpoints (routes/api.php) ask of a token, on top of it belonging to the console user. The bot's
   * plain token has every ability (*), and the service key of the API server only has ACT_AS_DISCORD_USER, so it can not do what
   * the bot does even though it belongs to the same user. Not a scope an API key can have.
   */
  public const string BOT_ENDPOINTS = 'bot-endpoints';

  /**
   * The ability of the bot's own token that lets it act on behalf of any Discord account.
   */
  public const string ACT_AS_DISCORD_USER = 'act-as-discord-user';

  /**
   * @return list<string>
   */
  public static function values():array {
    return array_map(static fn(self $scope) => $scope->value, self::cases());
  }
}
