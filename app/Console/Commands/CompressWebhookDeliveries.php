<?php

namespace App\Console\Commands;

use App\Models\WebhookDelivery;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CompressWebhookDeliveries extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:compress-webhook-deliveries';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Collapse individually logged webhook_deliveries rows for fully-elapsed hours into one summary row per hour';

  /**
   * Execute the console command.
   */
  public function handle():int {
    // Never touch the current hour - it's still receiving individual rows.
    $cutoff = now('UTC')->startOfHour();

    $hourBuckets = DB::table('webhook_deliveries')
      ->where('occurred_at', '<', $cutoff)
      ->where('request_count', 1)
      ->select(DB::raw("date_trunc('hour', occurred_at) as bucket"))
      ->distinct()
      ->orderBy('bucket')
      ->pluck('bucket');

    foreach ($hourBuckets as $bucket){
      $this->compressHour(Carbon::parse($bucket, 'UTC'));
    }

    return 0;
  }

  /**
   * Compress all individually logged rows for a single hour into one summary row.
   */
  protected function compressHour(Carbon $hourStart):void {
    $hourEnd = $hourStart->copy()->addHour();

    $query = DB::table('webhook_deliveries')
      ->where('occurred_at', '>=', $hourStart)
      ->where('occurred_at', '<', $hourEnd)
      ->where('request_count', 1);

    $stats = $query->clone()->select(
      DB::raw('count(*) as request_count'),
      DB::raw('sum(error_count) as error_count'),
      DB::raw('avg(avg_duration_ms) as avg_duration_ms'),
      DB::raw('percentile_cont(0.95) within group (order by avg_duration_ms) as p95_duration_ms'),
    )->first();

    if (!$stats || (int)$stats->request_count === 0){
      return;
    }

    DB::transaction(function () use ($query, $stats, $hourStart) {
      $query->delete();

      WebhookDelivery::create([
        'occurred_at' => $hourStart,
        'request_count' => $stats->request_count,
        'error_count' => $stats->error_count,
        'avg_duration_ms' => round((float)$stats->avg_duration_ms, 2),
        'p95_duration_ms' => round((float)$stats->p95_duration_ms, 2),
      ]);
    });

    $this->info("Compressed webhook deliveries for {$hourStart->toIso8601String()}: {$stats->request_count} requests");
  }
}
