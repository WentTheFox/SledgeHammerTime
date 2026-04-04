<?php

namespace App\Enums;

enum AvatarProvider: string {
  case DISCORD = 'discord';
  case GRAVATAR = 'gravatar';
  case CROWDIN = 'crowdin';

  /**
   * @return array{provider: string, id: string}|null
   */
  public static function parseUri(?string $uri): ?array {
    if ($uri === null) return null;
    $parts = parse_url($uri);
    if (!$parts || ($parts['scheme'] ?? null) !== 'provider') return null;
    $provider = self::tryFrom($parts['host'] ?? '');
    if ($provider === null) return null;
    $id = ltrim($parts['path'] ?? '', '/');
    if (empty($id)) return null;
    return ['provider' => $provider->value, 'id' => $id];
  }
}
