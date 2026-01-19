<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('page_views', function (Blueprint $table) {
      $table->uuid('id')->primary()->default(new Expression('gen_random_uuid()'));
      $table->string('route_name')->default(null)->nullable();
      $table->string('locale')->default(null)->nullable();
      $table->bigInteger('amount', unsigned: true)->default(1);
      $table->timestampsTz();

      $table->index(['created_at', 'locale', 'route_name']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('page_views');
  }
};
