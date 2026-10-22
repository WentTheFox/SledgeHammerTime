<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * API keys created on the website act as exactly one of the user's linked Discord accounts, which is
   * the account whose bot settings they read and change. The bot's own token has no account.
   */
  public function up():void {
    Schema::table('personal_access_tokens', function (Blueprint $table) {
      $table->bigInteger('discord_user_id')->nullable()->index();
      $table->foreign('discord_user_id')->references('id')->on('discord_users')->onUpdate('cascade')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('personal_access_tokens', function (Blueprint $table) {
      $table->dropForeign(['discord_user_id']);
      $table->dropColumn('discord_user_id');
    });
  }
};
