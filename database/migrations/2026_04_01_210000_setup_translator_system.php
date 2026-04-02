<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Make crowdin_users.user_id nullable
        Schema::table('crowdin_users', function (Blueprint $table) {
            $table->foreignUuid('user_id')->nullable()->change();
        });

        // Create translators table
        Schema::create('translators', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('project_id');
            $table->foreignId('crowdin_user_id')->constrained('crowdin_users');
            $table->string('language_code', 10);
            $table->integer('translated')->default(0);
            $table->integer('approved')->default(0);
            $table->integer('voted')->default(0);
            $table->timestamps();

            $table->unique(['project_id', 'crowdin_user_id', 'language_code']);
            $table->index('translated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translators');

        Schema::table('crowdin_users', function (Blueprint $table) {
            $table->foreignUuid('user_id')->nullable(false)->change();
        });
    }
};
