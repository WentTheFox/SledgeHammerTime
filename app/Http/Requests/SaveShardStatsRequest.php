<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class SaveShardStatsRequest extends ConsoleUserFormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'id' => 'required|integer|min:0',
      'server_count' => 'required|integer|min:0',
      'member_count' => 'present|nullable|integer|min:0',
      'started_at' => 'required|date',
    ];
  }
}
