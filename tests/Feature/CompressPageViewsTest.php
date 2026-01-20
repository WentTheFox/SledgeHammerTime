<?php

namespace Tests\Feature;

use App\Http\Middleware\TrackPageViews;
use App\Models\PageView;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CompressPageViewsTest extends TestCase
{
  use DatabaseTransactions;

  public function test_it_compresses_page_views_for_the_last_two_days_by_default()
  {
    PageView::truncate();
    $this->withoutMiddleware(TrackPageViews::class);
    // Set "now" to midnight of Jan 20th UTC
    Carbon::setTestNow(Carbon::create(2026, 1, 20, 0, 0, 0, 'UTC'));

    // Create records for two days ago (Jan 18th) UTC
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 1, 'date' => '2026-01-18', 'created_at' => Carbon::create(2026, 1, 18, 10, 0, 0, 'UTC')]);

    // Create records for yesterday (Jan 19th) UTC
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 5, 'date' => '2026-01-19', 'created_at' => Carbon::create(2026, 1, 19, 15, 0, 0, 'UTC')]);

    // Create a record for today (Jan 20th) UTC - should NOT be compressed
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 1, 'date' => '2026-01-20', 'created_at' => Carbon::create(2026, 1, 20, 0, 0, 1, 'UTC')]);

    $this->artisan('app:compress-page-views')
      ->expectsOutput('Compressed page views for 2026-01-18. Total amount: 1')
      ->expectsOutput('Compressed page views for 2026-01-19. Total amount: 5')
      ->assertExitCode(0);

    // Check records for Jan 18th
    $this->assertEquals(1, PageView::where('date', '2026-01-18')->count());

    // Check records for Jan 19th
    $this->assertEquals(1, PageView::where('date', '2026-01-19')->count());

    // Check that today's record is still there
    $this->assertEquals(1, PageView::where('date', '2026-01-20')->count());
  }

  public function test_it_compresses_page_views_for_a_specific_date_range()
  {
    // Records for Jan 15th
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 2, 'date' => '2026-01-15', 'created_at' => Carbon::create(2026, 1, 15, 12, 0, 0, 'UTC')]);

    // Record for Jan 16th
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 1, 'date' => '2026-01-16', 'created_at' => Carbon::create(2026, 1, 16, 10, 0, 0, 'UTC')]);

    // Record for Jan 17th
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 4, 'date' => '2026-01-17', 'created_at' => Carbon::create(2026, 1, 17, 10, 0, 0, 'UTC')]);

    $this->artisan('app:compress-page-views 2026-01-15 2026-01-16')
      ->expectsOutput('Compressed page views for 2026-01-15. Total amount: 2')
      ->expectsOutput('Compressed page views for 2026-01-16. Total amount: 1')
      ->assertExitCode(0);

    // Jan 15th and 16th should be compressed
    $this->assertEquals(1, PageView::where('date', '2026-01-15')->count());
    $this->assertEquals(1, PageView::where('date', '2026-01-16')->count());

    // Jan 17th should NOT be compressed
    $this->assertEquals(1, PageView::where('date', '2026-01-17')->where('amount', 4)->count());
  }

  public function test_it_compresses_page_views_while_keeping_locales_separate()
  {
    PageView::truncate();
    $this->withoutMiddleware(TrackPageViews::class);
    // Set "now" to Jan 20th UTC
    Carbon::setTestNow(Carbon::create(2026, 1, 20, 0, 0, 0, 'UTC'));

    // Create records for yesterday (Jan 19th) with different locales
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 5, 'date' => '2026-01-19', 'created_at' => Carbon::create(2026, 1, 19, 10, 0, 0, 'UTC')]);
    PageView::forceCreate(['route_name' => 'about', 'locale' => 'en', 'amount' => 3, 'date' => '2026-01-19', 'created_at' => Carbon::create(2026, 1, 19, 12, 0, 0, 'UTC')]);
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'fr', 'amount' => 10, 'date' => '2026-01-19', 'created_at' => Carbon::create(2026, 1, 19, 15, 0, 0, 'UTC')]);
    PageView::forceCreate(['route_name' => 'home', 'locale' => null, 'amount' => 2, 'date' => '2026-01-19', 'created_at' => Carbon::create(2026, 1, 19, 16, 0, 0, 'UTC')]);

    $this->artisan('app:compress-page-views')
      ->assertExitCode(0);

    // Should have 4 records for Jan 19th: 'en' x 'home', 'en' x 'about', 'fr' x 'home', null x 'home'
    $this->assertEquals(4, PageView::where('date', '2026-01-19')->count());

    $enHomeRecord = PageView::where('locale', 'en')->where('route_name', 'home')->where('date', '2026-01-19')->first();
    $this->assertNotNull($enHomeRecord);
    $this->assertEquals(5, $enHomeRecord->amount);

    $enAboutRecord = PageView::where('locale', 'en')->where('route_name', 'about')->where('date', '2026-01-19')->first();
    $this->assertNotNull($enAboutRecord);
    $this->assertEquals(3, $enAboutRecord->amount);

    $frRecord = PageView::where('locale', 'fr')->where('date', '2026-01-19')->first();
    $this->assertNotNull($frRecord);
    $this->assertEquals(10, $frRecord->amount);
    $this->assertEquals('home', $frRecord->route_name);

    $nullRecord = PageView::whereNull('locale')->where('date', '2026-01-19')->first();
    $this->assertNotNull($nullRecord);
    $this->assertEquals(2, $nullRecord->amount);
    $this->assertEquals('home', $nullRecord->route_name);
  }

  public function test_it_compresses_page_views_for_a_specific_date_parameter()
  {
    // Records for Jan 15th
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 2, 'date' => '2026-01-15', 'created_at' => Carbon::create(2026, 1, 15, 12, 0, 0, 'UTC')]);
    PageView::forceCreate(['route_name' => 'about', 'locale' => 'en', 'amount' => 3, 'date' => '2026-01-15', 'created_at' => Carbon::create(2026, 1, 15, 14, 0, 0, 'UTC')]);

    // Record for Jan 16th
    PageView::forceCreate(['route_name' => 'home', 'locale' => 'en', 'amount' => 1, 'date' => '2026-01-16', 'created_at' => Carbon::create(2026, 1, 16, 10, 0, 0, 'UTC')]);

    $this->artisan('app:compress-page-views 2026-01-15')
      ->expectsOutput('Compressed page views for 2026-01-15. Total amount: 5')
      ->expectsOutput('- about (en): 3')
      ->expectsOutput('- home (en): 2')
      ->assertExitCode(0);

    // Jan 15th should be compressed (2 records instead of many, based on route/locale)
    $this->assertEquals(2, PageView::where('date', '2026-01-15')->count());

    // Jan 16th should NOT be compressed
    $this->assertEquals(1, PageView::where('date', '2026-01-16')->count());
  }
}
