<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * Option uses get a source like the command executions already have, so adoption of the bot, the API and the MCP server
   * can be told apart. Everything recorded so far came from the bot.
   */
  public function up():void {
    Schema::table('telemetry_command_option_uses', function (Blueprint $table) {
      $table->string('source', 16)->default('discord-bot');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('telemetry_command_option_uses', function (Blueprint $table) {
      $table->dropColumn('source');
    });
  }
};
