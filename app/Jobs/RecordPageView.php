<?php

namespace App\Jobs;

use App\Models\PageView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RecordPageView implements ShouldQueue
{
  use Queueable;

  /**
   * Create a new job instance.
   */
  public function __construct(protected ?string $routeName, protected ?string $locale)
  {
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    $record = new PageView();
    $record->route_name = $this->routeName;
    $record->locale = $this->locale;
    $record->date = now('UTC')->toDateString();
    $record->save();
  }
}
