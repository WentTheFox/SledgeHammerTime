<?php

namespace App\Models;

interface AvatarUrlProvider {
  public function getAvatarUrl(): ?string;
}
