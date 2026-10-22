<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateApiKeyRequest extends FormRequest {
  public function authorize():bool {
    return true;
  }

  /**
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'token' => 'required|string|max:255',
    ];
  }
}
