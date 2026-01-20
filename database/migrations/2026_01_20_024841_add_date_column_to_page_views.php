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
    Schema::table('page_views', function (Blueprint $table) {
      $table->date('date')->default(new Expression('date(now())'))->nullable();

      $table->dropIndex(['created_at', 'locale', 'route_name']);
      $table->index(['date', 'locale', 'route_name']);
    });

    DB::table('page_views')->update(['date' => new Expression('date(created_at)')]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('page_views', function (Blueprint $table) {
      $table->dropIndex(['date', 'locale', 'route_name']);
      $table->dropColumn('date');
      $table->index(['created_at', 'locale', 'route_name']);
    });
  }
};
