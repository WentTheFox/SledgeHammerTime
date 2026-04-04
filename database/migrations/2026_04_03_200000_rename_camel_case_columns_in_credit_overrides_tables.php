<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::table('translation_credit_overrides', function (Blueprint $table) {
      $table->renameColumn('displayName', 'display_name');
      $table->renameColumn('avatarUrl', 'avatar_url');
    });

    Schema::table('translation_credit_override_proposals', function (Blueprint $table) {
      $table->renameColumn('displayName', 'display_name');
      $table->renameColumn('avatarUrl', 'avatar_url');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('translation_credit_overrides', function (Blueprint $table) {
      $table->renameColumn('display_name', 'displayName');
      $table->renameColumn('avatar_url', 'avatarUrl');
    });

    Schema::table('translation_credit_override_proposals', function (Blueprint $table) {
      $table->renameColumn('display_name', 'displayName');
      $table->renameColumn('avatar_url', 'avatarUrl');
    });
  }
};
