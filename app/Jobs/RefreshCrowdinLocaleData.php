<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\Crowdin\CrowdinCreditsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class RefreshCrowdinLocaleData implements ShouldQueue {
  use Queueable;

  public function __construct(public readonly string $locale) {}

  /**
   * @return array<int, object>
   */
  public function middleware(): array {
    return [
      new WithoutOverlapping($this->locale)->dontRelease(),
    ];
  }

  public function handle(CrowdinCreditsService $service): void {
    $service->refreshLocaleData($this->locale);
  }
}
