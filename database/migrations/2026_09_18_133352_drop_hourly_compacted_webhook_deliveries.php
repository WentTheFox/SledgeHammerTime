<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    // app:compress-webhook-deliveries used to collapse each fully-elapsed hour into a
    // single row (request_count > 1) before it was changed to collapse 5-minute buckets
    // instead. Those old hourly rows would now render as one lone spike per hour with 55
    // minutes of empty buckets on either side, once the chart's own bucketing switched to
    // 5 minutes - worse than just not having that data point at all. Raw (request_count =
    // 1) rows are untouched; only already-compacted summary rows are dropped, since the
    // fine-grained data behind them can't be recovered anyway.
    DB::table('webhook_deliveries')->where('request_count', '>', 1)->delete();
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    // Deleted rows are not restored - see up().
  }
};
