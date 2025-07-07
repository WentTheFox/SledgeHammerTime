<?php

namespace App\Console\Commands;

use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\TelemetryUsage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateTelemetryUsage extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:calculate-telemetry-usage';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Upsert telemetry usage records and remove stale ones';

  protected const STATISTICS_DAYS_CUTOFF = 90;

  /**
   * Execute the console command.
   */
  public function handle() {
    DB::transaction(function () {
      $cutoff = self::STATISTICS_DAYS_CUTOFF;
      $sourceCommand = BotCommand::class;
      $sourceOption = BotCommandOption::class;
      TelemetryUsage::truncate();

      $usageData = DB::select(<<<SQL
        SELECT
            DISTINCT((ce.created_at AT TIME ZONE 'UTC')::date) AS date,
            COUNT(ce.id) AS value,
            ce.bot_command_id::varchar as source_id,
            :sourceCommand AS source_type
        FROM telemetry_command_executions ce
        WHERE ce.created_at >= NOW() - INTERVAL '$cutoff DAY'
        GROUP BY date, source_id
        UNION ALL
        SELECT
            DISTINCT((cou.created_at AT TIME ZONE 'UTC')::date) AS date,
            COUNT(cou.id) AS value,
            cou.bot_command_option_id::varchar as source_id,
            :sourceOption AS source_type
        FROM telemetry_command_option_uses cou
        WHERE cou.created_at >= NOW() - INTERVAL '$cutoff DAY'
        GROUP BY date, source_id
      SQL
        , [':sourceCommand' => $sourceCommand, ':sourceOption' => $sourceOption]);

      TelemetryUsage::insert(array_map(fn(\stdClass $item) => (array)$item, $usageData));
    });
  }
}
