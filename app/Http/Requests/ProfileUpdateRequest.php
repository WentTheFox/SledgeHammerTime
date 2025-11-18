<?php

namespace App\Http\Requests;

use App\Enums\DiscordTimestampFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProfileUpdateRequest extends FormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules():array {
    return [
      'name' => ['required', 'string', 'max:50'],
      'hidden_formats' => ['nullable', 'array'],
      'hidden_formats.*' => ['string', new Enum(DiscordTimestampFormat::class)],
    ];
  }
}
