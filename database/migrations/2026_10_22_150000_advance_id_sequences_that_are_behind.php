<?php

use App\Support\PostgresSequences;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * Production's personal_access_tokens sequence was behind the ids in the table (the table was restored with ids
   * of its own), so creating a token failed with a duplicate key. Other tables restored the same way would fail
   * the same way the first time something is inserted, so this repairs every sequence that is behind, and only
   * those. It changes data, not the schema, and does nothing on a database that is fine.
   */
  public function up():void {
    if (DB::getDriverName() !== 'pgsql'){
      return;
    }

    $advanced = PostgresSequences::advanceBehind();
    if ($advanced !== []){
      Log::notice('Moved id sequences that were behind their table: '.implode(', ', $advanced));
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    // A sequence that was behind was a fault, there is nothing to put back
  }
};
