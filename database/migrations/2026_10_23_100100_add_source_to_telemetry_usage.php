<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * The daily usage is rebuilt every hour from the raw rows, and now has a row per source for each command or option and
   * day. The unique index grows by the source, and the old one goes only after the new one is there. The release before this
   * one still works with it: it inserts a single row per day, which the source defaults for.
   */
  public function up():void {
    Schema::table('telemetry_usage', function (Blueprint $table) {
      $table->string('source', 16)->default('discord-bot');
      $table->unique(['source_id', 'source_type', 'date', 'source']);
    });
    Schema::table('telemetry_usage', function (Blueprint $table) {
      $table->dropUnique(['source_id', 'source_type', 'date']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * Rows of other sources are dropped first: they would break the narrower index, and the hourly rebuild writes them back.
   */
  public function down():void {
    Schema::table('telemetry_usage', function (Blueprint $table) {
      $table->dropUnique(['source_id', 'source_type', 'date', 'source']);
    });
    DB::table('telemetry_usage')->where('source', '!=', 'discord-bot')->delete();
    Schema::table('telemetry_usage', function (Blueprint $table) {
      $table->unique(['source_id', 'source_type', 'date']);
      $table->dropColumn('source');
    });
  }
};
