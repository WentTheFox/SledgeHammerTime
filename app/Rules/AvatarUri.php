<?php

namespace App\Rules;

use App\Services\AvatarProvider\AvatarResolverService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class AvatarUri implements ValidationRule {
  protected string $message = 'The :attribute is not a valid avatar URI.';

  public function __construct(protected AvatarResolverService $avatarResolver) {}

  public function validate($attribute, $value, $fail):void {
    $validationResult = $this->avatarResolver->validate(Auth::user(), $value);

    if (is_string($validationResult)) {
      $fail($validationResult);
    }
  }
}
