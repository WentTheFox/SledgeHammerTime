<?php

namespace App\Models;

interface ProfileUrlProvider {
  public function getProfileUrl(): ?string;
}
