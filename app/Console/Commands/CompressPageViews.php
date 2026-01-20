<?php

namespace App\Console\Commands;

use App\Models\PageView;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CompressPageViews extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:compress-page-views {startDate? : The start date (YYYY-MM-DD). Defaults to two days ago.} {endDate? : The end date (YYYY-MM-DD). Defaults to yesterday.}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Compress all records in the pageviews table for a date range into daily summary records';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $startDateArgument = $this->argument('startDate');
    $endDateArgument = $this->argument('endDate');

    if ($startDateArgument) {
      $startDate = Carbon::parse($startDateArgument, 'UTC')->startOfDay();
      if ($endDateArgument) {
        $endDate = Carbon::parse($endDateArgument, 'UTC')->startOfDay();
      } else {
        $endDate = $startDate->copy();
      }
    } else {
      $startDate = now('UTC')->subDays(2)->startOfDay();
      $endDate = now('UTC')->subDay()->startOfDay();
    }

    if ($startDate->gt($endDate)) {
      $this->error('Start date must be before or equal to end date.');
      return 1;
    }

    $currentDate = $startDate->copy();

    while ($currentDate->lte($endDate)) {
      $this->compressDay($currentDate);
      $currentDate->addDay();
    }

    return 0;
  }

  /**
   * Compress page views for a specific day.
   *
   * @param Carbon $targetDate
   */
  protected function compressDay(Carbon $targetDate)
  {
    $targetDateString = $targetDate->toDateString();

    $query = PageView::where('date', $targetDateString);

    $stats = PageView::where('date', $targetDateString)
      ->select('locale', 'route_name', DB::raw('SUM(amount) as total_amount'))
      ->groupBy('locale', 'route_name')
      ->orderBy('route_name')
      ->orderBy('locale')
      ->get();

    if ($stats->isNotEmpty()) {
      DB::transaction(function () use ($query, $stats, $targetDateString) {
        $query->delete();

        foreach ($stats as $stat) {
          PageView::forceCreate([
            'route_name' => $stat->route_name,
            'locale' => $stat->locale,
            'amount' => $stat->total_amount,
            'date' => $targetDateString,
            'created_at' => Carbon::parse($targetDateString, 'UTC'),
          ]);
        }
      });

      $overallTotal = $stats->sum('total_amount');
      $this->info("Compressed page views for {$targetDateString}. Total amount: {$overallTotal}");

      foreach ($stats as $stat) {
        $locale = $stat->locale ?? 'N/A';
        $route = $stat->route_name ?? 'N/A';
        $this->line("- {$route} ({$locale}): {$stat->total_amount}");
      }
    } else {
      $this->info("No page views found for {$targetDateString} to compress.");
    }
  }
}
