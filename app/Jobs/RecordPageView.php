<?php

namespace App\Jobs;

use App\Models\PageView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class RecordPageView implements ShouldQueue
{
  use Queueable;

  /**
   * Total attempts (1 initial + 2 retries) - covers a job getting orphaned by a transient
   * infra blip (e.g. Redis briefly OOM-killed) without needing a code fix; this only ever
   * writes a page-view counter, so a couple of quick retries is worth it before giving up.
   */
  public int $tries = 3;

  /**
   * Create a new job instance.
   *
   * @param array<string, string> $uaHeaders User agent related server variables (HTTP_USER_AGENT, etc.)
   */
  public function __construct(protected ?string $routeName, protected ?string $locale, protected array $uaHeaders = [])
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
    $record->is_crawler = (new CrawlerDetect($this->uaHeaders))->isCrawler();
    $record->date = now('UTC')->toDateString();
    $record->save();
  }
}
