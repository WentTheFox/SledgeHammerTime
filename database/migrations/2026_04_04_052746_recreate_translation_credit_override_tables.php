<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    // Tables are empty; drop and recreate to avoid constraint-existence issues across environments.
    Schema::drop('translation_credit_override_proposals');
    Schema::drop('translation_credit_overrides');

    Schema::create('translation_credit_overrides', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->unsignedBigInteger('crowdin_user_id');
      $table->string('language_code', 10);
      $table->foreign('crowdin_user_id')->references('id')->on('crowdin_users')->cascadeOnDelete();
      $table->unique(['crowdin_user_id', 'language_code']);
      $table->foreignUuid('created_by')->constrained('users')->cascadeOnDelete();
      $table->foreignUuid('approved_by')->nullable()->default(null)->constrained('users')->nullOnDelete();
      $table->timestampTz('approved_at')->nullable()->default(null);
      $table->string('display_name')->nullable();
      $table->string('avatar_url')->nullable();
      $table->string('url')->nullable();
      $table->boolean('hide')->default(false);
      $table->timestamps();
    });

    Schema::create('translation_credit_override_proposals', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->unsignedBigInteger('crowdin_user_id');
      $table->string('language_code', 10);
      $table->foreign('crowdin_user_id')->references('id')->on('crowdin_users')->cascadeOnDelete();
      $table->unique(['crowdin_user_id', 'language_code']);
      $table->foreignUuid('proposed_by')->constrained('users')->cascadeOnDelete();
      $table->foreignUuid('rejected_by')->nullable()->constrained('users')->nullOnDelete();
      $table->timestamp('rejected_at')->nullable();
      $table->string('display_name')->nullable();
      $table->string('avatar_url')->nullable();
      $table->string('url')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::drop('translation_credit_override_proposals');
    Schema::drop('translation_credit_overrides');

    Schema::create('translation_credit_overrides', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('translator_id')->constrained('translators')->cascadeOnDelete();
      $table->foreignUuid('created_by')->constrained('users')->cascadeOnDelete();
      $table->foreignUuid('approved_by')->nullable()->default(null)->constrained('users')->nullOnDelete();
      $table->timestampTz('approved_at')->nullable()->default(null);
      $table->string('display_name')->nullable();
      $table->string('avatar_url')->nullable();
      $table->string('url')->nullable();
      $table->boolean('hide')->default(false);
      $table->timestamps();
    });

    Schema::create('translation_credit_override_proposals', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('translator_id')->unique()->constrained('translators')->cascadeOnDelete();
      $table->foreignUuid('proposed_by')->constrained('users')->cascadeOnDelete();
      $table->foreignUuid('rejected_by')->nullable()->constrained('users')->nullOnDelete();
      $table->timestamp('rejected_at')->nullable();
      $table->string('display_name')->nullable();
      $table->string('avatar_url')->nullable();
      $table->string('url')->nullable();
      $table->timestamps();
    });
  }
};
