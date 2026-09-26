<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PageViewTrackingTest extends TestCase
{
  use DatabaseTransactions;

  public function test_it_records_page_view_on_home_page()
  {
    $this->get('/en');

    $this->assertDatabaseHas('page_views', [
      'route_name' => 'home',
      'locale' => 'en',
      'amount' => 1,
      'date' => now('UTC')->toDateString(),
    ]);
  }

  public function test_it_records_page_view_on_legal_page()
  {
    $this->get('/en/legal');

    $this->assertDatabaseHas('page_views', [
      'route_name' => 'legal',
      'locale' => 'en',
      'amount' => 1,
      'date' => now('UTC')->toDateString(),
    ]);
  }

  public function test_it_flags_page_views_from_crawlers()
  {
    $this->withHeader('User-Agent', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; PerplexityBot/1.0; +https://perplexity.ai/perplexitybot)')
      ->get('/en/legal');

    $this->assertDatabaseHas('page_views', [
      'route_name' => 'legal',
      'locale' => 'en',
      'is_crawler' => true,
    ]);
  }

  public function test_it_does_not_flag_page_views_from_browsers()
  {
    $this->withHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0')
      ->get('/en/legal');

    $this->assertDatabaseHas('page_views', [
      'route_name' => 'legal',
      'locale' => 'en',
      'is_crawler' => false,
    ]);
    $this->assertDatabaseMissing('page_views', [
      'route_name' => 'legal',
      'is_crawler' => true,
    ]);
  }

  public function test_it_flags_page_views_from_outdated_browsers()
  {
    $this->withHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36')
      ->get('/en/legal');

    $this->assertDatabaseHas('page_views', [
      'route_name' => 'legal',
      'locale' => 'en',
      'is_crawler' => true,
    ]);
  }

  public function test_it_does_not_flag_status_page_views_from_monitors()
  {
    $this->withHeader('User-Agent', 'got (https://github.com/sindresorhus/got)')
      ->get('/status');

    $this->assertDatabaseHas('page_views', [
      'route_name' => 'status',
      'locale' => null,
      'is_crawler' => false,
    ]);
    $this->assertDatabaseMissing('page_views', [
      'route_name' => 'status',
      'is_crawler' => true,
    ]);
  }
}
