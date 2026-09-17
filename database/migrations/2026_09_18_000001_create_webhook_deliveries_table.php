<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('webhook_deliveries', function (Blueprint $table) {
      $table->uuid('id')->primary()->default(new Expression('gen_random_uuid()'));
      $table->timestampTz('occurred_at');
      // A freshly logged request is one row with request_count 1 and avg/p95 both
      // equal to its own duration. app:compress-webhook-deliveries later collapses
      // a fully-elapsed hour's rows into a single row with the real aggregates,
      // computed once while the individual durations are still around to percentile
      // over - see that command for why the shape works either way.
      $table->unsignedInteger('request_count')->default(1);
      $table->unsignedInteger('error_count')->default(0);
      $table->decimal('avg_duration_ms', 10, 2);
      $table->decimal('p95_duration_ms', 10, 2);

      $table->index('occurred_at');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('webhook_deliveries');
  }
};
