<?php

namespace App\Services\AvatarProvider;

use App\Enums\AvatarProvider;
use App\Models\AvatarUrlProvider;
use App\Models\CrowdinUser;
use App\Models\DiscordUser;
use App\Models\User;
use Illuminate\Support\Str;

class AvatarResolverService {
  public function resolve(User $authUser, string $avatarUrl):?AvatarUrlProvider {
    $result = $this->validate($authUser, $avatarUrl);

    return is_string($result) ? null : $result;
  }

  public function validate(User $authUser, string $value):string|AvatarUrlProvider {
    // Must be a valid URL-like structure
    $parts = parse_url($value);

    if (!$parts){
      return 'Invalid URI format.';
    }

    if (($parts['scheme'] ?? null) !== 'provider'){
      return 'Invalid provider URI scheme.';
    }

    /**
     * @var AvatarProvider|null $provider
     */
    $provider = AvatarProvider::tryFrom($parts['host'] ?? '');

    if ($provider === null){
      return 'Invalid provider name.';
    }

    $path = $parts['path'] ?? '';
    $id = ltrim($path, '/');

    if (empty($id)){
      return 'Missing provider identifier.';
    }

    switch ($provider){
      case AvatarProvider::DISCORD:
        return $this->validateDiscordId($authUser, $id);
      case AvatarProvider::CROWDIN:
        return $this->validateCrowdinId($authUser, $id);
      case AvatarProvider::GRAVATAR:
        return $this->validateGravatarHash($id);
      default:
        return 'Unknown avatar provider.';
    }
  }

  protected function validateDiscordId(User $authUser, string $id):string|AvatarUrlProvider {
    if (!ctype_digit($id)){
      return 'Discord ID must be numeric.';
    }

    // Placeholder: check if the ID belongs to the user
    $discordUser = $this->getDiscordUserOfCurrentUserById($authUser, $id);
    if ($discordUser === null){
      return 'Discord ID does not match any of your connected accounts.';
    }

    return $discordUser;
  }

  protected function validateCrowdinId(User $authUser, string $id):string|AvatarUrlProvider {
    if (!ctype_digit($id)){
      return 'Crowdin ID must be numeric.';
    }

    // Placeholder: check if the ID belongs to the user
    $crowdinUser = $this->getCrowdinUserOfCurrentUserById($authUser, $id);
    if ($crowdinUser === null){
      return 'Crowdin ID does not match any of your connected accounts.';
    }

    return $crowdinUser;
  }

  public function resolveUri(?string $uri):?string {
    if ($uri === null) return null;
    $parsed = AvatarProvider::parseUri($uri);
    if ($parsed === null) return null;

    $provider = AvatarProvider::from($parsed['provider']);
    $id = $parsed['id'];

    return match ($provider) {
      AvatarProvider::DISCORD => DiscordUser::find($id)?->getAvatarUrl(),
      AvatarProvider::CROWDIN => CrowdinUser::find($id)?->getAvatarUrl(),
      AvatarProvider::GRAVATAR => (new GravatarUser($id))->getAvatarUrl(),
    };
  }

  protected function validateGravatarHash(string $hash):string|AvatarUrlProvider {
    if (Str::length($hash) !== 32){
      return 'Gravatar hash must be a 32-character MD5 string.';
    }

    if (!ctype_xdigit($hash)){
      return 'Gravatar hash must contain only hexadecimal characters.';
    }

    return new GravatarUser($hash);
  }

  protected function getDiscordUserOfCurrentUserById(User $authUser, string $id):?DiscordUser {
    return $authUser->discordUsers()->where('id', $id)->select(['id', 'avatar'])->first();
  }

  protected function getCrowdinUserOfCurrentUserById(User $authUser, string $id):?CrowdinUser {
    return $authUser->crowdinUsers()->where('id', $id)->select(['id', 'avatar_url'])->first();
  }
}
