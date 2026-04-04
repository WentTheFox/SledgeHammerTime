<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class UpdateBotTimezonesRequest extends ConsoleUserFormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'timezones' => 'required|array|min:1',
      'timezones.*' => 'string|min:1|max:64',
    ];
  }
}
