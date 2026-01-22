<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use DateInterval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnalyticsController extends Controller {
  private const CACHE_KEY = 'analytics-page-data-v1';

  public function index() {
    if (config('analytics.enabled') !== true){
      throw new NotFoundHttpException();
    }

    return Inertia::render('Analytics/IndexComponent', $this->getCachedPageData());
  }

  protected function getCachedPageData() {
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

  private function collectPageData() {
    $startDate = Carbon::now('UTC')->subDays(29)->startOfDay();

    // 1. Daily totals for Stacked Bar Chart (grouped by date and route)
    $dailyTotals = PageView::where('date', '>=', $startDate->toDateString())
      ->select('date', 'route_name', DB::raw('SUM(amount) as total'))
      ->groupBy('date', 'route_name')
      ->orderBy('date')
      ->orderByDesc('total')
      ->get()
      ->map(fn($item) => [
        'date' => $item->date,
        'route' => $item->route_name,
        'total' => (int)$item->total,
      ]);

    // 2. Breakdown by Route for Donut Chart
    $routeBreakdown = PageView::where('date', '>=', $startDate->toDateString())
      ->select('route_name', DB::raw('SUM(amount) as total'))
      ->groupBy('route_name')
      ->orderByDesc('total')
      ->get()
      ->map(fn($item) => [
        'route' => $item->route_name ?? null,
        'total' => (int)$item->total,
      ]);

    // 3. Breakdown by Locale for Donut Chart
    $localeBreakdown = PageView::where('date', '>=', $startDate->toDateString())
      ->select('locale', DB::raw('SUM(amount) as total'))
      ->groupBy('locale')
      ->orderByDesc('total')
      ->get()
      ->map(fn($item) => [
        'locale' => $item->locale ?? null,
        'total' => (int)$item->total,
      ]);

    return [
      'lastUpdated' => date('c'),
      'dailyTotals' => $dailyTotals,
      'routeBreakdown' => $routeBreakdown,
      'localeBreakdown' => $localeBreakdown,
    ];
  }
}
