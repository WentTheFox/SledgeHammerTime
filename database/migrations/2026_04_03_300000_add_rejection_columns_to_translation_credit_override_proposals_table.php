<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up():void {
    Schema::table('translation_credit_override_proposals', function (Blueprint $table) {
      $table->foreignUuid('rejected_by')->nullable()->constrained('users')->nullOnDelete();
      $table->timestamp('rejected_at')->nullable();
    });
  }

  public function down():void {
    Schema::table('translation_credit_override_proposals', function (Blueprint $table) {
      $table->dropConstrainedForeignId('rejected_by');
      $table->dropColumn('rejected_at');
    });
  }
};
