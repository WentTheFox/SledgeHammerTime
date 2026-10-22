<?php

namespace App\Http\Requests;

use App\Enums\ApiKeyScope;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreApiKeyRequest extends FormRequest {
  /**
   * The lifetimes the page offers, in days. No value means the key does not expire.
   */
  public const array EXPIRY_DAYS = [30, 90, 365];

  public function authorize():bool {
    return $this->user() !== null;
  }

  /**
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules():array {
    return [
      'name' => ['required', 'string', 'min:1', 'max:64'],
      // Only an account linked to the user can be used, so one can not act as somebody else
      'discord_user_id' => ['required', Rule::exists('discord_users', 'id')->where('user_id', $this->user()?->id)],
      'scopes' => ['required', 'array', 'min:1'],
      'scopes.*' => ['required', Rule::enum(ApiKeyScope::class)],
      'expires_in_days' => ['nullable', 'integer', Rule::in(self::EXPIRY_DAYS)],
    ];
  }

  /**
   * @return list<callable(Validator): void>
   */
  public function after():array {
    return [
      function (Validator $validator) {
        if ($this->user()->tokens()->whereNotNull('discord_user_id')->count() >= ApiKeyService::MAX_KEYS_PER_USER){
          $validator->errors()->add('name', __('profile.apiKeys.limitReached', ['max' => ApiKeyService::MAX_KEYS_PER_USER]));
        }
      },
    ];
  }
}
