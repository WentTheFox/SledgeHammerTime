<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::table('crowdin_users', function (Blueprint $table) {
      $table->string('access_token', 1200)->nullable()->change();
      $table->string('refresh_token', 1000)->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('crowdin_users', function (Blueprint $table) {
      $table->string('access_token', 128)->nullable()->change();
      $table->string('refresh_token', 128)->nullable()->change();
    });
  }
};
