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
  protected $description = 'Collapse individually logged webhook_deliveries rows for fully-elapsed 5-minute buckets into one summary row per bucket';

  private const string BUCKET_WIDTH = '5 minutes';

  /**
   * Execute the console command.
   */
  public function handle():int {
    // Never touch the current bucket - it's still receiving individual rows.
    $now = now('UTC');
    $cutoff = $now->copy()->startOfMinute()->subMinutes($now->minute % 5);

    $buckets = DB::table('webhook_deliveries')
      // A Carbon value bound directly here gets formatted without a UTC offset by the
      // query grammar, so Postgres reinterprets it using the DB session's own timezone
      // (config('app.timezone'), Europe/Budapest - not UTC) instead of taking it as UTC -
      // silently shifting every comparison in this command by that timezone's offset. See
      // WebhookDelivery::$dateFormat for the same failure mode on the model's own column.
      ->where('occurred_at', '<', self::formatUtc($cutoff))
      ->where('request_count', 1)
      ->select(DB::raw("date_bin('".self::BUCKET_WIDTH."', occurred_at, timestamptz '2000-01-01') as bucket"))
      ->distinct()
      ->orderBy('bucket')
      ->pluck('bucket');

    foreach ($buckets as $bucket){
      $this->compressBucket(Carbon::parse($bucket, 'UTC'));
    }

    return 0;
  }

  /**
   * Compress all individually logged rows for a single 5-minute bucket into one summary row.
   */
  protected function compressBucket(Carbon $bucketStart):void {
    $bucketEnd = $bucketStart->copy()->addMinutes(5);

    $query = DB::table('webhook_deliveries')
      ->where('occurred_at', '>=', self::formatUtc($bucketStart))
      ->where('occurred_at', '<', self::formatUtc($bucketEnd))
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

    DB::transaction(function () use ($query, $stats, $bucketStart) {
      $query->delete();

      WebhookDelivery::create([
        'occurred_at' => $bucketStart,
        'request_count' => $stats->request_count,
        'error_count' => $stats->error_count,
        'avg_duration_ms' => round((float)$stats->avg_duration_ms, 2),
        'p95_duration_ms' => round((float)$stats->p95_duration_ms, 2),
      ]);
    });

    $this->info("Compressed webhook deliveries for {$bucketStart->toIso8601String()}: {$stats->request_count} requests");
  }

  /**
   * Format a Carbon instance with an explicit UTC offset for use as a query binding - see
   * the comment in handle() for why a bare Carbon object here would be misinterpreted.
   */
  private static function formatUtc(Carbon $value):string {
    return $value->format('Y-m-d H:i:sP');
  }
}
