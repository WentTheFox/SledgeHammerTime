<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * config/queue.php's `failed` driver (database-uuids) has always pointed at this table, but it was
 * never created - so every job that exhausted its tries was silently dropped instead of recorded.
 */
return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('failed_jobs', function (Blueprint $table) {
      $table->id();
      $table->string('uuid')->unique();
      $table->string('connection');
      $table->string('queue');
      $table->longText('payload');
      $table->longText('exception');
      $table->timestamp('failed_at')->useCurrent();

      $table->index(['connection', 'queue', 'failed_at']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('failed_jobs');
  }
};
