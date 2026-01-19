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
    ]);
  }

  public function test_it_records_page_view_on_legal_page()
  {
    $this->get('/en/legal');

    $this->assertDatabaseHas('page_views', [
      'route_name' => 'legal',
      'locale' => 'en',
      'amount' => 1,
    ]);
  }
}
