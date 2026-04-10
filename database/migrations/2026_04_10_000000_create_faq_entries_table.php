<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('faq_entries', function (Blueprint $table) {
      $table->integer('identifier')->primary();
      $table->string('topic', 255);
      $table->string('source_text', 2000);
      $table->text('converted_html');
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('faq_entries');
  }
};
