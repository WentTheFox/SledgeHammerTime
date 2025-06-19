<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  private const UNIQUE_COLUMNS = ['bot_command_id', 'name'];

  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::table('bot_command_options', function (Blueprint $table) {
      $table->dropUnique(self::UNIQUE_COLUMNS);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('bot_command_options', function (Blueprint $table) {
      $table->unique(self::UNIQUE_COLUMNS);
    });
  }
};
