<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CopyCreditOverrideRequest extends FormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, array<string|ValidationRule>>
   */
  public function rules():array {
    return [
      'source_language' => ['required', 'string', 'regex:/^[a-zA-Z0-9-]+$/', 'max:255'],
    ];
  }
}
