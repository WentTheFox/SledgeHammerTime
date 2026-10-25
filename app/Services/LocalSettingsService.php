<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Inertia\Ssr\SsrState;
use Throwable;

/**
 * Class LocalSettingsService.
 */
class LocalSettingsService {
  public const THEMES = [null, 'light', 'dark'];

  /**
   * @param Request|null $request
   *
   * @return array<string, string|null>
   */
  public static function resolveLocalSettings(?Request $request = null):array {
    $settingsString = self::resolveLocalSettingsString($request);
    if (is_string($settingsString)){
      try {
        return json_decode($settingsString, associative: true, flags: JSON_THROW_ON_ERROR);
      }
      catch (Throwable $e){
        Log::warning('Failed to parse settings string: '.$e->getMessage(), [
          'settings_string' => $settingsString,
        ]);
      }
    }

    return [];
  }

  public static function resolveLocalSettingsString(?Request $request = null):?string {
    $settingsCookie = $request?->cookie(config('app.settings_cookie_name'));
    if ($settingsCookie === null){
      $pageData = app(SsrState::class)->page;
      $theme = Arr::get($pageData, 'props.app.theme');
      $lightThemeValue = null;
      if ($theme !== null) {
        $lightThemeValue = $theme === 'light' ? 'true' : 'false';
      }
      $settingsCookie = json_encode(['light-theme' => $lightThemeValue]);
    }

    return is_string($settingsCookie) ? $settingsCookie : null;
  }

  public static function resolveTheme(?Request $request = null):?string {
    $theme = null;
    $settings = self::resolveLocalSettings($request);
    if (isset($settings['light-theme'])){
      $theme = $settings['light-theme'] === 'true' ? 'light' : 'dark';
    }

    return $theme;
  }
}
