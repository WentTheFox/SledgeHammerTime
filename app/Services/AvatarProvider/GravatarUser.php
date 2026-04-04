<?php

namespace App\Services\AvatarProvider;

use App\Models\AvatarUrlProvider;

final readonly class GravatarUser implements AvatarUrlProvider {
  public function __construct(public string $hash) {}

  public function getAvatarUrl(): string {
    return "https://www.gravatar.com/avatar/{$this->hash}?size=128&rating=g";
  }
}
