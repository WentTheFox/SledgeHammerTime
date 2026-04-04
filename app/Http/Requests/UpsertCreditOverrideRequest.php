<?php

namespace App\Http\Requests;

use App\Rules\AvatarUri;
use App\Services\AvatarProvider\AvatarResolverService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpsertCreditOverrideRequest extends FormRequest {
  public function __construct(protected AvatarResolverService $avatarResolver) {
    parent::__construct();
  }

  protected function prepareForValidation():void {
    $provider = $this->input('avatar_provider');
    $id = $this->input('avatar_id');
    $this->merge([
      'avatar_url' => ($provider !== null && $id !== null)
        ? "provider://{$provider}/{$id}"
        : null,
    ]);
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, array<string|ValidationRule>>
   */
  public function rules():array {
    return [
      'display_name' => ['nullable', 'string', 'max:255'],
      'avatar_url' => ['nullable', 'string', new AvatarUri($this->avatarResolver), 'max:255'],
      'url' => ['nullable', 'string', 'url', 'max:255'],
      'hide' => ['boolean'],
    ];
  }
}
