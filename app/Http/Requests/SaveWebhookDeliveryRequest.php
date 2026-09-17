<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class SaveWebhookDeliveryRequest extends ConsoleUserFormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'status_code' => 'required|integer|min:100|max:599',
      'duration_ms' => 'required|integer|min:0',
      'occurred_at' => 'required|date',
    ];
  }
}
