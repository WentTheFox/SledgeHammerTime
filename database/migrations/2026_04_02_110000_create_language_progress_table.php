<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    Schema::create('translation_progress', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->bigInteger('project_id');
      $table->string('language_code', 10);
      $table->unsignedTinyInteger('translation')->default(0);
      $table->unsignedTinyInteger('approval')->default(0);
      $table->timestamps();

      $table->unique(['project_id', 'language_code']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::dropIfExists('translation_progress');
  }
};
