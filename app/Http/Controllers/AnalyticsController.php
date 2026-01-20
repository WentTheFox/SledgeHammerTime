<?php

namespace App\Http\Controllers;

use App\Models\PageView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AnalyticsController extends Controller
{
  public function index()
  {
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

    return Inertia::render('Analytics/IndexComponent', [
      'dailyTotals' => $dailyTotals,
      'routeBreakdown' => $routeBreakdown,
      'localeBreakdown' => $localeBreakdown,
    ]);
  }
}
