<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\CrowdinUser;
use App\Services\Crowdin\CrowdinUserService;
use DragonCode\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class RefreshCrowdinUserInfo implements ShouldQueue, ShouldBeUnique {
  use Queueable;

  public const string RATE_LIMIT_KEY = 'refresh-user-info:crowdin';

  protected CrowdinUserService $crowdinUserService;
  public readonly string $crowdinUserId;

  public function __construct($crowdinUserId) {
    $this->crowdinUserId = (string)$crowdinUserId;
    $this->crowdinUserService = app(CrowdinUserService::class);
  }

  /**
   * Get the middleware the job should pass through.
   *
   * @return array<int, object>
   */
  public function middleware():array {
    return [
      new WithoutOverlapping($this->crowdinUserId),
    ];
  }

  /**
   * Execute the job.
   */
  public function handle():CrowdinUser {
    return $this->crowdinUserService->refreshUserInfo($this->crowdinUserId);
  }

  /**
   * Get the unique ID for the job.
   */
  public function uniqueId():string {
    return $this->crowdinUserId;
  }

  public function uniqueFor():int {
    return 60 * 5;
  }
}
