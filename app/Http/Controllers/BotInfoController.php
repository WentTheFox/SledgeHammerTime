<?php

namespace App\Http\Controllers;

use App\Enums\BotInfoUsageType;
use App\Http\Requests\BotInfoUsageRequest;
use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\BotCommandTranslation;
use App\Models\TelemetryUsage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class BotInfoController extends Controller {
  private const string WEBHOOK_DELIVERY_STATS_CACHE_KEY = 'webhook-delivery-stats-v1';
  private const int WEBHOOK_DELIVERY_STATS_WINDOW_HOURS = 48;

  public function index(): InertiaResponse {
    return Inertia::render('BotInfo/IndexComponent', [
      'discordAppId' => config('services.discord.client_id'),
      'commands' => BotCommand::with(['options' => ['choices']])->orderBy('type')->orderByRaw('total_executions IS NULL')->orderBy('total_executions', 'desc')->orderBy('name')->get(),
      'translations' => BotCommandTranslation::where('locale', App::getLocale())->get()
        ->map(fn(BotCommandTranslation $t) => $t->mapToUiInfo()),
      'webhookDeliveryStatsWindowHours' => self::WEBHOOK_DELIVERY_STATS_WINDOW_HOURS,
    ]);
  }

  public function webhookDeliveryStats(): JsonResponse {
    return response()->json(
      Cache::remember(self::WEBHOOK_DELIVERY_STATS_CACHE_KEY, now()->addSeconds(30), fn() => $this->collectWebhookDeliveryStats()),
    );
  }

  private const int WEBHOOK_DELIVERY_STATS_BUCKET_MINUTES = 5;

  /**
   * @return array<array{bucket: string, requestCount: int, errorRate: float, avgDurationMs: ?float, p95DurationMs: ?float}>
   */
  private function collectWebhookDeliveryStats(): array {
    $startTime = Carbon::now('UTC')->subHours(self::WEBHOOK_DELIVERY_STATS_WINDOW_HOURS - 1)->startOfHour();

    $rowsByBucket = DB::table('webhook_deliveries')
      // A bare Carbon value binds without a UTC offset, so Postgres reinterprets it using
      // the DB session's own timezone (config('app.timezone'), not UTC) instead of taking
      // it as UTC - silently shrinking the window by that timezone's offset. See
      // WebhookDelivery::$dateFormat / app:compress-webhook-deliveries for the same bug.
      ->where('occurred_at', '>=', $startTime->format('Y-m-d H:i:sP'))
      ->select(
        // Fixed epoch origin so bucket boundaries land on the same wall-clock 5-minute
        // marks (:00, :05, :10, ...) regardless of window start - must match the bucket
        // width app:compress-webhook-deliveries collapses raw rows into (see that command),
        // and the grid generated below to zero-fill buckets with no data.
        DB::raw("date_bin('5 minutes', occurred_at, timestamptz '2000-01-01') as bucket"),
        DB::raw('sum(request_count) as request_count'),
        DB::raw('sum(error_count) as error_count'),
        DB::raw('sum(avg_duration_ms * request_count) / sum(request_count) as avg_duration_ms'),
        // Each row is either a single request (avg = p95 = its own duration) or an
        // already-compressed bucket (one row, so this trivially returns its stored
        // p95) - see app:compress-webhook-deliveries for why that holds.
        DB::raw('percentile_cont(0.95) within group (order by avg_duration_ms) as p95_duration_ms'),
      )
      ->groupBy('bucket')
      ->get()
      // Postgres returns the bucket with its own session-timezone offset (e.g. +02:00, not
      // Z) - Carbon::parse()'s 2nd arg is only a fallback for strings with no offset of
      // their own, so it's ignored here and the string keeps that +02:00 instead of being
      // converted to UTC. Without the explicit ->utc(), these keys silently never match the
      // UTC-generated grid keys below despite representing the same instant.
      ->keyBy(fn($row) => Carbon::parse($row->bucket)->utc()->toIso8601String());

    // Chart.js's category axis spaces every point evenly regardless of the real time gap
    // between them, so a sparsely-populated result (real traffic doesn't land in every
    // 5-minute slot) would otherwise visually compress/distort the timeline - a 5-minute
    // gap and a 50-minute gap would look identical. Walking the full grid and emitting a
    // zero-request placeholder for empty slots keeps every bucket the same real-world width.
    $results = [];
    $cursor = $startTime->copy();
    $lastBucketStart = Carbon::now('UTC');
    $lastBucketStart->subMinutes($lastBucketStart->minute % self::WEBHOOK_DELIVERY_STATS_BUCKET_MINUTES)->startOfMinute();
    while ($cursor->lte($lastBucketStart)){
      $key = $cursor->toIso8601String();
      $row = $rowsByBucket->get($key);

      $results[] = $row === null
        ? ['bucket' => $key, 'requestCount' => 0, 'errorRate' => 0, 'avgDurationMs' => null, 'p95DurationMs' => null]
        : [
          'bucket' => $key,
          'requestCount' => (int)$row->request_count,
          'errorRate' => (int)$row->request_count > 0 ? round($row->error_count / $row->request_count, 4) : 0,
          'avgDurationMs' => round((float)$row->avg_duration_ms, 1),
          'p95DurationMs' => round((float)$row->p95_duration_ms, 1),
        ];

      $cursor->addMinutes(self::WEBHOOK_DELIVERY_STATS_BUCKET_MINUTES);
    }

    return $results;
  }

  public function usage(BotInfoUsageRequest $request): JsonResponse|Response {
    $data = $request->validated();
    $type = match ($data['type']) {
      BotInfoUsageType::COMMAND->value => BotCommand::class,
      BotInfoUsageType::OPTION->value => BotCommandOption::class,
      default => null,
    };

    if ($type === null){
      return response(status: 404);
    }

    $usage = TelemetryUsage::where('source_id', $data['id'])->where('source_type', $type)->get();

    return response()->json($usage->map(fn(TelemetryUsage $item) => $item->mapToUiInfo()));
  }
}
