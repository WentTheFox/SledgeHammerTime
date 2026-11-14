<?php

namespace App\Console\Commands;

use App\Http\Middleware\CachePageResponse;
use Illuminate\Console\Command;

class ClearPageCache extends Command {
  protected $signature = 'app:clear-page-cache';
  protected $description = 'Clear the cached full-page HTML responses for all cacheable pages across all supported locales';

  public function handle():int {
    foreach (CachePageResponse::ENABLED_ROUTES as $page){
      $count = CachePageResponse::forgetPage($page);
      $this->info("Cleared {$page->value} cache for {$count} locale(s).");
    }

    return Command::SUCCESS;
  }
}
