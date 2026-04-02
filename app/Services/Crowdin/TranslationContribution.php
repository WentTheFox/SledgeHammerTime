<?php

namespace App\Services\Crowdin;

use App\Models\CrowdinUser;

final readonly class TranslationContribution {
  public function __construct(
    public CrowdinUser $crowdinUser,
    public ?string $languageCode,
    public int $translationStrings,
    public int $approvalStrings,
    public int $votedStrings,
  ) {
  }
}
