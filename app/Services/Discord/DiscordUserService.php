<?php

declare(strict_types=1);

namespace App\Services\Discord;

use App\Models\DiscordUser;
use App\Models\Settings;
use Illuminate\Container\Attributes\Singleton;
use Illuminate\Support\Facades\Redis;
use JsonException;

#[Singleton]
class DiscordUserService {
  public const int SETTINGS_CACHE_DURATION_SECONDS = 5 * 60;

  public function __construct(protected DiscordApiService $discordApiService) { }

  public function clearSettingsCache(DiscordUser $discordUser):void {
    Redis::del($discordUser->settings_cache_key);
  }

  /**
   * @return array<string, mixed>
   * @throws JsonException
   */
  public function getSettingsRecord(DiscordUser $discordUser, bool $cache = true):array {
    if ($cache){
      $cacheKey = $discordUser->settings_cache_key;

      $cachedData = Redis::get($cacheKey);
      if ($cachedData){
        return json_decode($cachedData, true);
      }
    }

    $settings = $this->getSettingsRecordUncached($discordUser);
    if ($cache){
      Redis::set($cacheKey, json_encode($settings, JSON_THROW_ON_ERROR), 'EX', self::SETTINGS_CACHE_DURATION_SECONDS);
    }

    return $settings;
  }

  /**
   * @return array<string, mixed>
   */
  protected function getSettingsRecordUncached(DiscordUser $discordUser):array {
    /**
     * @var array<string, mixed> $settings
     */
    $settings = $discordUser->settings()->get(['setting', 'value'])->reduce(fn(array $acc, Settings $s) => [
      ...$acc,
      $s->setting => $s->value,
    ], []);
    return $settings;
  }

  public function refreshUserInfo(string $discordUserId):DiscordUser {
    $userInfo = $this->discordApiService->getUser($discordUserId);

    return $this->updateUserInfo($userInfo);
  }

  protected function updateUserInfo(GetUserResponse $data):DiscordUser {
    return DiscordUser::updateOrCreate([
      'id' => $data->id,
    ], [
      'id' => $data->id,
      'name' => $data->username,
      'display_name' => $data->global_name,
      'discriminator' => $data->discriminator,
      'avatar' => $data->avatar,
      'updated_at' => now(),
    ]);
  }
}
