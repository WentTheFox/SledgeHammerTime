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

  /**
   * @return array<array{bucket: string, requestCount: int, errorRate: float, avgDurationMs: float, p95DurationMs: float}>
   */
  private function collectWebhookDeliveryStats(): array {
    $startTime = Carbon::now('UTC')->subHours(self::WEBHOOK_DELIVERY_STATS_WINDOW_HOURS - 1)->startOfHour();

    return DB::table('webhook_deliveries')
      // A bare Carbon value binds without a UTC offset, so Postgres reinterprets it using
      // the DB session's own timezone (config('app.timezone'), not UTC) instead of taking
      // it as UTC - silently shrinking the window by that timezone's offset. See
      // WebhookDelivery::$dateFormat / app:compress-webhook-deliveries for the same bug.
      ->where('occurred_at', '>=', $startTime->format('Y-m-d H:i:sP'))
      ->select(
        // Fixed epoch origin so bucket boundaries land on the same wall-clock 5-minute
        // marks (:00, :05, :10, ...) regardless of window start - must match the bucket
        // width app:compress-webhook-deliveries collapses raw rows into (see that command).
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
      ->orderBy('bucket')
      ->get()
      ->map(fn($row) => [
        'bucket' => Carbon::parse($row->bucket, 'UTC')->toIso8601String(),
        'requestCount' => (int)$row->request_count,
        'errorRate' => (int)$row->request_count > 0 ? round($row->error_count / $row->request_count, 4) : 0,
        'avgDurationMs' => round((float)$row->avg_duration_ms, 1),
        'p95DurationMs' => round((float)$row->p95_duration_ms, 1),
      ])
      ->toArray();
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
