<?php

namespace App\Http\Requests;

use App\Enums\TelemetrySource;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InternalCommandTelemetryRequest extends FormRequest {
  public function authorize():bool {
    return true;
  }

  /**
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'commandName' => 'required|string|min:1|max:32',
      'locale' => 'required|string|min:1|max:10',
      'source' => ['required', Rule::enum(TelemetrySource::class)],
      'options' => 'nullable|array|max:25',
      'options.*.name' => 'required|string|min:1|max:32',
      'options.*.type' => 'nullable|integer',
    ];
  }
}
