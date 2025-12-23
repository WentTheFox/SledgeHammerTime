<?php

namespace App\Jobs;

use App\Models\DiscordUser;
use App\Services\Discord\DiscordUserService;
use DragonCode\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;

class RefreshDiscordUserInfo implements ShouldQueue, ShouldBeUnique {
  use Queueable;

  public const string RATE_LIMIT_KEY = 'refresh-user-info:discord';

  protected DiscordUserService $discordUserService;

  public function __construct(public string $discordUserId) {
    $this->discordUserService = app(DiscordUserService::class);
  }

  /**
   * Get the middleware the job should pass through.
   *
   * @return array<int, object>
   */
  public function middleware():array {
    return [
      new WithoutOverlapping($this->discordUserId),
    ];
  }

  /**
   * Execute the job.
   */
  public function handle():DiscordUser {
    sleep(10);

    return $this->discordUserService->refreshUserInfo($this->discordUserId);
  }

  /**
   * Get the unique ID for the job.
   */
  public function uniqueId():string {
    return $this->discordUserId;
  }

  public function uniqueFor():int {
    return 60 * 5;
  }
}
