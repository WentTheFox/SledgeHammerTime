<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersistLocalSettings extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize():bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'combined-inputs' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'custom-date-input' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'custom-time-input' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'first-day-of-week' => ['nullable', 'string', Rule::in(['0', '1', '2', '3', '4', '5', '6'])],
      'flat-ui' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'hide-how-to' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'hour-cycle' => ['nullable', 'string', Rule::in(['h12', 'h24'])],
      'light-theme' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'local-format-order' => ['nullable', 'string', 'json', 'min:2', 'max:64'],
      'local-hidden-formats' => ['nullable', 'string', 'json', 'min:2', 'max:64'],
      'nlp-input' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'sidebar-right' => ['nullable', 'string', Rule::in(['true', 'false'])],
      'timezone-sticky-headers' => ['nullable', 'string', Rule::in(['true', 'false'])],
    ];
  }
}
