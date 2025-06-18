<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('crowdin_users', function (Blueprint $table) {
      $table->bigInteger('id')->primary();
      $table->string('username', 255);
      $table->string('full_name', 255)->nullable();
      $table->string('avatar_url', 255)->nullable();
      $table->string('access_token', 128)->nullable();
      $table->string('refresh_token', 128)->nullable();
      $table->string('scopes', 128)->nullable();
      $table->timestampTz('token_expires')->nullable();
      $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
      $table->string('display_name')->nullable();
      $table->timestampsTz();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('crowdin_users');
  }
};
