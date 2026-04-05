<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SitemapController extends Controller {
  private const CACHE_KEY = 'sitemap-xml';
  private const CACHE_TTL = 86400; // 24 hours

  public function sitemap():Response {
    $xml = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
      $locales = Config::get('languages.supported_locales');

      $urls = [];

      foreach ($locales as $locale){
        $urls[] = [
          'loc' => route('home', ['locale' => $locale]),
          'changefreq' => 'weekly',
          'priority' => '1.0',
        ];
        $urls[] = [
          'loc' => route('botInfo', ['locale' => $locale]),
          'changefreq' => 'monthly',
          'priority' => '0.8',
        ];
        $urls[] = [
          'loc' => route('addBot', ['locale' => $locale]),
          'changefreq' => 'monthly',
          'priority' => '0.7',
        ];
        $urls[] = [
          'loc' => route('analytics', ['locale' => $locale]),
          'changefreq' => 'daily',
          'priority' => '0.5',
        ];
        $urls[] = [
          'loc' => route('legal', ['locale' => $locale]),
          'changefreq' => 'monthly',
          'priority' => '0.1',
        ];
      }

      return view('sitemap', compact('urls'))->render();
    });

    return response($xml, 200, ['Content-Type' => 'application/xml']);
  }
}
