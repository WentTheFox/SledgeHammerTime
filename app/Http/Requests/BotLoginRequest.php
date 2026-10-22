<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * The data of a login link, and the request of the user who opens one. That user is not logged in yet, what
 * lets them through is the signature of the link, which the controller checks.
 */
class BotLoginRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize():bool {
    return is_numeric($this->route('discordUserId')) && is_string($this->route('locale'));
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'name' => ['required', 'string', 'max:32'],
      'display_name' => ['nullable', 'string', 'max:32'],
      'discriminator' => ['required', 'integer', 'min:0', 'max:9999'],
      'avatar' => ['nullable', 'string', 'max:64'],
    ];
  }
}
