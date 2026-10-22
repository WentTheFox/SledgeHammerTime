<?php

declare(strict_types=1);

namespace App\Services\Discord;

use App\Models\DiscordUser;
use App\Models\Settings;
use Illuminate\Container\Attributes\Singleton;
use Illuminate\Support\Facades\DB;
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
      Redis::setex($cacheKey, self::SETTINGS_CACHE_DURATION_SECONDS, json_encode($settings, JSON_THROW_ON_ERROR));
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

  /**
   * The settings the bot (and the API) act on: what the account customised on top of the defaults.
   * An account the bot has never seen has no customisations.
   *
   * @return array<string, mixed>
   * @throws JsonException
   */
  public function getSettingsWithDefaults(string|int $discordUserId):array {
    $discordUser = DiscordUser::find($discordUserId);

    return Settings::mergeWithDefaults($discordUser ? $this->getSettingsRecord($discordUser) : []);
  }

  /**
   * Makes the stored settings exactly $data: a setting that is not in it (or is null) goes back to its default.
   *
   * @param array<string, mixed> $data
   */
  public function replaceSettings(DiscordUser $discordUser, array $data):void {
    /** @var Settings[] $currentSettings */
    $currentSettings = $discordUser->settings()->get();
    DB::transaction(function () use ($discordUser, $data, $currentSettings) {
      foreach ($currentSettings as $setting){
        $shouldDelete = !isset($data[$setting->setting]);
        /** @var Settings $setting */
        if (!$shouldDelete && Settings::shouldDeleteIfMatchingDefault($setting->setting, $data[$setting->setting])){
          $shouldDelete = true;
          unset($data[$setting->setting]);
        }
        if ($shouldDelete){
          $setting->delete();
        }
        else {
          $setting->value = $data[$setting->setting];
          $setting->save();
        }
        unset($data[$setting->setting]);
      }

      $newSettingData = [];
      foreach ($data as $settingName => $value){
        if (Settings::shouldDeleteIfMatchingDefault($settingName, $value))
          continue;
        $newSettingData[] = ['setting' => $settingName, 'value' => $value];
      }
      $discordUser->settings()->createMany($newSettingData);
    });

    $this->clearSettingsCache($discordUser);
  }

  /**
   * Changes only the given settings, a null value resets one to its default.
   *
   * @param array<string, mixed> $patch
   * @throws JsonException
   */
  public function patchSettings(DiscordUser $discordUser, array $patch):void {
    $settings = array_merge($this->getSettingsRecord($discordUser, cache: false), $patch);

    $this->replaceSettings($discordUser, array_filter($settings, static fn($value) => $value !== null));
  }

  public function refreshUserInfo(string $discordUserId):DiscordUser {
    $userInfo = $this->discordApiService->getUser($discordUserId);

    return $this->updateUserInfo($userInfo);
  }

  public function updateUserInfo(GetUserResponse $data):DiscordUser {
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
