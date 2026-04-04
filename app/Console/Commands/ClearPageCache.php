<?php

namespace App\Console\Commands;

use App\Http\Middleware\CachePageResponse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ClearPageCache extends Command {
  protected $signature = 'app:clear-page-cache';
  protected $description = 'Clear the cached full-page HTML responses for all cacheable pages across all supported locales';

  public function handle(): int {
    $pages = ['picker', 'botinfo'];
    $localeCount = count(Config::get('languages.ui_locale_map', []));

    foreach ($pages as $page) {
      CachePageResponse::forgetPage($page);
      $this->info("Cleared {$page} cache for {$localeCount} locale(s).");
    }

    return Command::SUCCESS;
  }
}
