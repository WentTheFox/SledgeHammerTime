<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class ReviewTranslationCreditOverrideProposal extends ConsoleUserFormRequest {
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'decision' => ['required','string', Rule::in(['approve', 'deny'])],
      'approver' => 'required|array',
      'approver.id' => 'required|numeric',
      'approver.username' => ['required', 'string', 'max:32'],
      'approver.global_name' => ['nullable', 'string', 'max:32'],
      'approver.discriminator' => ['required', 'integer', 'min:0', 'max:9999'],
      'approver.avatar' => ['nullable', 'string', 'max:64'],
    ];
  }
}
