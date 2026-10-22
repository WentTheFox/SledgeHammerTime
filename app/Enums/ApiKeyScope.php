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
