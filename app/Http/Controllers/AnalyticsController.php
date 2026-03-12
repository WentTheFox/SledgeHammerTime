<?php

namespace App\Http\Controllers;

use DateInterval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use JsonException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnalyticsController extends Controller {
  private const string CACHE_KEY = 'analytics-page-data-v1';

  public function index(): Response {
    if (config('analytics.enabled') !== true){
      throw new NotFoundHttpException();
    }

    return Inertia::render('Analytics/IndexComponent', $this->getCachedPageData());
  }

  /**
   * @return array<mixed>
   * @throws JsonException
   */
  protected function getCachedPageData(): array {
    $cacheEnabled = config('analytics.cache_enabled');
    if ($cacheEnabled && Cache::has(self::CACHE_KEY)){
      return json_decode(Cache::get(self::CACHE_KEY), associative: true, flags: JSON_THROW_ON_ERROR);
    }

    $data = $this->collectPageData();
    if ($cacheEnabled){
      $cacheTtlMinutes = config('analytics.cache_ttl_minutes');
      Cache::set(self::CACHE_KEY, json_encode($data, JSON_THROW_ON_ERROR), new DateInterval("PT{$cacheTtlMinutes}M"));
    }

    return $data;
  }

  /**
   * @return array{
   *   lastUpdated: non-falsy-string,
   *   dailyTotals: array{date: non-falsy-string, route: string, total: int},
   *   routeBreakdown: array{route: string|null, total: int},
   *   localeBreakdown: array{locale: string|null, total: int},
   * }
   */
  private function collectPageData():array {
    $startDate = Carbon::now('UTC')->subDays(29)->startOfDay();

    // 1. Daily totals for Stacked Bar Chart (grouped by date and route)
    $dailyTotals = DB::query()->where('date', '>=', $startDate->toDateString())
      ->select('date', 'route_name', DB::raw('SUM(amount) as total'))
      ->from('page_views')
      ->groupBy('date', 'route_name')
      ->orderBy('date')
      ->orderByDesc('total')
      ->get()
      ->map(fn($item) => [
        'date' => $item->date,
        'route' => $item->route_name,
        'total' => (int)$item->total,
      ])
      ->toArray();

    // 2. Breakdown by Route for Donut Chart
    $routeBreakdown = DB::query()->where('date', '>=', $startDate->toDateString())
      ->select('route_name', DB::raw('SUM(amount) as total'))
      ->from('page_views')
      ->groupBy('route_name')
      ->orderByDesc('total')
      ->get()
      ->map(fn($item) => [
        'route' => $item->route_name ?? null,
        'total' => (int)$item->total,
      ])
      ->toArray();

    // 3. Breakdown by Locale for Donut Chart
    $localeBreakdown = DB::query()->where('date', '>=', $startDate->toDateString())
      ->select('locale', DB::raw('SUM(amount) as total'))
      ->from('page_views')
      ->groupBy('locale')
      ->orderByDesc('total')
      ->get()
      ->map(fn($item) => [
        'locale' => $item->locale ?? null,
        'total' => (int)$item->total,
      ])
      ->toArray();

    return [
      'lastUpdated' => date('c'),
      'dailyTotals' => $dailyTotals,
      'routeBreakdown' => $routeBreakdown,
      'localeBreakdown' => $localeBreakdown,
    ];
  }
}
