<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class UpdateFaqEntriesRequest extends ConsoleUserFormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    return [
      'entries' => 'required|array',
      'entries.*.identifier' => 'required|int|min:0|max:9999',
      'entries.*.topic' => 'required|string|min:1|max:255',
      'entries.*.source_text' => 'required|string|min:1|max:2000',
      'channels' => 'sometimes|array',
      'channels.*.id' => 'required|numeric',
      'channels.*.name' => 'required|string|min:1|max:100',
      'users' => 'sometimes|array',
      'users.*.id' => 'required|numeric',
      'users.*.name' => 'required|string|min:1|max:100',
      'roles' => 'sometimes|array',
      'roles.*.id' => 'required|numeric',
      'roles.*.name' => 'required|string|min:1|max:100',
      'guild_id' => 'required|string|numeric',
    ];
  }
}
