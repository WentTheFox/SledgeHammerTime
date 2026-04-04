<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    foreach (['translation_credit_overrides', 'translation_credit_override_proposals'] as $tableName) {
      Schema::table($tableName, function (Blueprint $table) {
        $table->dropConstrainedForeignId('translator_id');
        $table->unsignedBigInteger('crowdin_user_id')->after('id');
        $table->string('language_code', 10)->after('crowdin_user_id');
        $table->foreign('crowdin_user_id')->references('id')->on('crowdin_users')->cascadeOnDelete();
        $table->unique(['crowdin_user_id', 'language_code']);
      });
    }
  }

  public function down(): void {
    foreach (['translation_credit_overrides', 'translation_credit_override_proposals'] as $tableName) {
      Schema::table($tableName, function (Blueprint $table) {
        $table->dropUnique(['crowdin_user_id', 'language_code']);
        $table->dropForeign(['crowdin_user_id']);
        $table->dropColumn(['crowdin_user_id', 'language_code']);
        $table->foreignUuid('translator_id')->constrained('translators')->cascadeOnDelete();
      });
    }
  }
};
