<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class TelemetryRequest extends ConsoleUserFormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'locale' => 'required|string|min:1|max:10',
      'commandId' => 'required|numeric',
      'options' => 'nullable|array|max:25',
      'options.*.name' => 'required|string|min:1|max:32',
    ];
  }
}
