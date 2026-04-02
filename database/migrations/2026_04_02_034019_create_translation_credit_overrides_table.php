<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('translation_credit_overrides', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('translator_id')->constrained('translators')->cascadeOnDelete();
      $table->foreignUuid('created_by')->constrained('users')->cascadeOnDelete();
      $table->foreignUuid('approved_by')->nullable()->default(null)->constrained('users')->nullOnDelete();
      $table->string('displayName')->nullable();
      $table->string('avatarUrl')->nullable();
      $table->string('url')->nullable();
      $table->boolean('hide')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('translation_credit_overrides');
  }
};
