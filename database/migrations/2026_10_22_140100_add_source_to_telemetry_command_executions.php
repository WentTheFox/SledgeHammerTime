<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * Command runs now also come from the public API and the MCP server. Everything recorded so far came from the bot.
   */
  public function up():void {
    Schema::table('telemetry_command_executions', function (Blueprint $table) {
      $table->string('source', 16)->default('discord-bot');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('telemetry_command_executions', function (Blueprint $table) {
      $table->dropColumn('source');
    });
  }
};
