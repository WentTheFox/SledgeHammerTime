<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class BotLoginRequest extends ConsoleUserFormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize():bool {
    return parent::authorize() && is_numeric($this->route('discordUserId')) && is_string($this->route('locale'));
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
