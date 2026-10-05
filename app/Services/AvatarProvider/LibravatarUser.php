<?php

namespace App\Services\AvatarProvider;

use App\Models\AvatarUrlProvider;
use PEAR\Services\Libravatar;

final readonly class LibravatarUser implements AvatarUrlProvider {

  protected Libravatar $service;

  public function __construct(public string $hash) {
    $this->service = new Libravatar();
    $this->service->setHttps(true);
    $this->service->setSize(128);
  }

  public function getAvatarUrl(): string {
    return $this->service->getUrl($this->hash);
  }
}
