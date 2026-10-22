<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Changes only the settings that are given, with the same rules as the settings page.
 * The API server has already checked that the key may change the settings of this account.
 */
class InternalSettingsPatchRequest extends FormRequest {
  public function authorize():bool {
    return true;
  }

  /**
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return BotSettingsUpdate::settingRules();
  }
}
