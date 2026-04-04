<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class ClearPickerCache extends Command {
  protected $signature = 'picker:clear-cache';
  protected $description = 'Clear the cached full-page HTML responses for the Picker page across all supported locales';

  public function handle(): int {
    $manifestHash = @md5_file(public_path('build/manifest.json')) ?: 'default';
    $locales = array_keys(Config::get('languages.ui_locale_map', []));

    foreach ($locales as $locale) {
      Cache::forget("picker-html-{$locale}-{$manifestHash}");
    }

    $this->info('Cleared picker cache for ' . count($locales) . ' locale(s) (manifest: ' . $manifestHash . ').');
    return Command::SUCCESS;
  }
}
