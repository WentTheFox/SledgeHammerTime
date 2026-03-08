<?php

namespace App\Models;

use App\Casts\Json;
use App\Enums\DiscordTimestampFormat;
use App\Enums\SettingNames;
use App\Enums\TimestampMessageColumns;
use App\Rules\ValidTimezone;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property SettingNames $name
 */
class Settings extends Model {
  use HasFactory;

  protected $fillable = [
    'setting',
    'value',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, class-string>
   */
  protected $casts = [
    'value' => Json::class,
  ];

  public function discordUser():BelongsTo {
    return $this->belongsTo(DiscordUser::class);
  }

  public function getNameAttribute():SettingNames {
    return SettingNames::from($this->setting);
  }

  /**
   * @param array<string, mixed> $userSettings
   *
   * @return array<string, mixed>
   * @throws Exception
   */
  public static function mergeWithDefaults(array $userSettings, bool $editing = false):array {
    return array_reduce(SettingNames::cases(), fn(array $acc, SettingNames $case) => [
      ...$acc,
      $case->value => self::getFormattedValue($userSettings, $case) ?? self::getDefaultValue($case, $editing),
    ], []);
  }

  /**
   * @param array<string, mixed> $userSettings
   */
  public static function getFormattedValue(array $userSettings, SettingNames $case):mixed {
    $value = $userSettings[$case->value] ?? null;
    if ($value === null){
      return null;
    }
    switch ($case){
      case SettingNames::TIMEZONE:
        if (preg_match(ValidTimezone::OFFSET_ZONE_REGEX, $value, $matches)){
          $hoursMultiplier = $matches[1] ? -1 : 1;
          $hours = max(min((int)$matches[2], 14), -14) * $hoursMultiplier;
          $minutes = max(min((int)($matches[3] ?? 0), 59), 0);

          return sprintf("GMT%s%s:%s", $hours < 0 ? '-' : '+', str_pad((string)abs($hours), 2, '0', STR_PAD_LEFT), str_pad((string)$minutes, 2, '0', STR_PAD_LEFT));
        }

        return $value;
      default:
        return $value;
    }
  }

  public static function getDefaultValue(string|SettingNames $setting, bool $editing = false): mixed {
    $settingName = is_string($setting) ? SettingNames::from($setting) : $setting;
    switch ($settingName){
      case SettingNames::FORMAT:
        return $editing ? DiscordTimestampFormat::DEFAULT->value : null;
      case SettingNames::COLUMNS:
        return $editing ? TimestampMessageColumns::DEFAULT->value : null;
      case SettingNames::EPHEMERAL:
      case SettingNames::HEADER:
      case SettingNames::BOLD_PREVIEW:
      case SettingNames::FORMAT_MINIMAL_REPLY:
      case SettingNames::TELEMETRY:
        return true;
      case SettingNames::TIMEZONE:
        return "GMT";
      case SettingNames::DEFAULT_AT_HOUR:
      case SettingNames::DEFAULT_AT12_HOUR:
      case SettingNames::DEFAULT_AT_MINUTE:
        return null;
      case SettingNames::DEFAULT_AT_SECOND:
        return 0;
      default:
        throw new Exception("Invalid setting: $setting");
    }
  }

  public static function shouldDeleteIfMatchingDefault(string $setting, mixed $value):bool {
    if ($value === null) return true;
    switch ($setting){
      case SettingNames::HEADER->value:
      case SettingNames::EPHEMERAL->value:
      case SettingNames::BOLD_PREVIEW->value:
        return false;
      default:
        return $value === self::getDefaultValue($setting, editing: true);
    }
  }
}
