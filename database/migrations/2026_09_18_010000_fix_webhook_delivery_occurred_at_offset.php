<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  /**
   * The webhook_deliveries feature's first hour or so in production stored occurred_at 2 hours
   * too early (see the fix in the WebhookDelivery model - a bare/offset-less datetime string was
   * getting interpreted using the DB session's timezone, Europe/Budapest, instead of UTC). This
   * corrects the rows written before that fix landed, using a cutoff exactly 2 hours before the
   * deploy that fixed it (2026-09-18 02:46:59 local) - any row written by the old code has an
   * occurred_at earlier than that cutoff by construction, and any row written by the fixed code
   * has an occurred_at at or after the real deploy time, comfortably above it.
   */
  public function up():void {
    // A leftover row from manually verifying the fix directly in production, left behind because
    // the debugging script errored out (on an unrelated pre-existing bug) before it could clean up
    // after itself.
    DB::table('webhook_deliveries')
      ->where('occurred_at', '2026-09-18 02:38:29+02')
      ->where('avg_duration_ms', 1)
      ->where('p95_duration_ms', 1)
      ->where('request_count', 1)
      ->where('error_count', 0)
      ->delete();

    DB::table('webhook_deliveries')
      ->where('occurred_at', '<', '2026-09-18 00:47:00')
      ->update(['occurred_at' => DB::raw("occurred_at + interval '2 hours'")]);
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    // Not reversible: the deleted test row is gone for good, and re-subtracting 2 hours from
    // "everything before 2026-09-18 02:47:00" would also catch legitimately-timestamped rows
    // written after this migration ran.
  }
};
