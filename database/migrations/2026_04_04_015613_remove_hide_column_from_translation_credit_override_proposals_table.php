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
        Schema::table('translation_credit_override_proposals', function (Blueprint $table) {
            $table->dropColumn('hide');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('translation_credit_override_proposals', function (Blueprint $table) {
            $table->boolean('hide')->default(false);
        });
    }
};
