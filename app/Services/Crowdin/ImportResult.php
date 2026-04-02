<?php

namespace App\Services\Crowdin;

final readonly class ImportResult {
  public function __construct(
    public int $created,
    public int $updated,
    public int $skipped,
  ) {
  }

  public function total():int {
    return $this->created + $this->updated;
  }
}
