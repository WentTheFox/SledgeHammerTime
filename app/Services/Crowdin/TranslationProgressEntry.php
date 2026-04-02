<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

final readonly class TranslationProgressEntry {
  public function __construct(
    public string $languageId,
    public int $translationProgress,
    public int $approvalProgress,
  ) {
  }
}
