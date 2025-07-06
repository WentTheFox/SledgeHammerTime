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
    Schema::create('telemetry_usage', function (Blueprint $table) {
      $table->uuid('id')->primary()->default(new Expression('gen_random_uuid()'));
      $table->string('source_type');
      $table->string('source_id');
      $table->date('date');
      $table->integer('value');

      $table->unique(['source_id', 'source_type', 'date']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('telemetry_usage');
  }
};
