<?php

namespace Tests\Feature;

use App\Http\Middleware\TrackPageViews;
use App\Models\PageView;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AnalyticsTest extends TestCase
{
  use DatabaseTransactions;

  public function test_analytics_page_is_accessible_to_users_with_horizon_access()
  {
    $user = User::factory()->create(['horizon_access' => true]);

    $this->actingAs($user)->get('/en/analytics')->assertSuccessful();
  }

  public function test_analytics_page_redirects_for_guests()
  {
    $this->get('/analytics')->assertRedirect('/en/analytics');
    $this->get('/en/analytics')->assertStatus(200);
  }

  public function test_analytics_data_is_correctly_aggregated()
  {
    PageView::query()->delete();
    $user = User::factory()->create();

    // Disable tracking for this request to avoid noise
    $this->withoutMiddleware(TrackPageViews::class);

    // Create some page views
    PageView::forceCreate([
      'route_name' => 'home',
      'locale' => 'en',
      'amount' => 10,
      'date' => Carbon::now('UTC')->subDays(2)->toDateString(),
      'created_at' => Carbon::now('UTC')->subDays(2),
    ]);

    PageView::forceCreate([
      'route_name' => 'legal',
      'locale' => 'fr',
      'amount' => 5,
      'date' => Carbon::now('UTC')->subDays(1)->toDateString(),
      'created_at' => Carbon::now('UTC')->subDays(1),
    ]);

    $response = $this->actingAs($user)->get('/en/analytics');

    $response->assertStatus(200);
    $response->assertInertia(fn($page) => $page
      ->component('Analytics/IndexComponent')
      ->has('dailyTotals')
      ->has('routeBreakdown')
      ->has('localeBreakdown')
    );

    $data = $response->viewData('page')['props'];

    $this->assertCount(2, $data['dailyTotals']);
    $this->assertCount(2, $data['routeBreakdown']);
    $this->assertCount(2, $data['localeBreakdown']);
  }
}
