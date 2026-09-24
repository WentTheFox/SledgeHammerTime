<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Switches the OAuth token columns to the `encrypted` model cast (APP_KEY): widens them to text,
 * since an encrypted payload is several times the plaintext's length, and encrypts the existing
 * plaintext values in place. Values that already decrypt are left alone, so a re-run is harmless.
 */
return new class extends Migration {
  private const array TABLES = [
    'discord_users' => ['access_token' => 128, 'refresh_token' => 128],
    'crowdin_users' => ['access_token' => 1200, 'refresh_token' => 1000],
  ];

  /**
   * Run the migrations.
   */
  public function up():void {
    foreach (self::TABLES as $tableName => $columns){
      Schema::table($tableName, function (Blueprint $table) use ($columns) {
        foreach (array_keys($columns) as $column){
          $table->text($column)->nullable()->change();
        }
      });

      $this->transformTokens($tableName, array_keys($columns), function (string $value):string {
        try {
          Crypt::decryptString($value);

          return $value;
        } catch (DecryptException){
          return Crypt::encryptString($value);
        }
      });
    }
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    foreach (self::TABLES as $tableName => $columns){
      $this->transformTokens($tableName, array_keys($columns), function (string $value):string {
        try {
          return Crypt::decryptString($value);
        } catch (DecryptException){
          return $value;
        }
      });

      Schema::table($tableName, function (Blueprint $table) use ($columns) {
        foreach ($columns as $column => $length){
          $table->string($column, $length)->nullable()->change();
        }
      });
    }
  }

  /**
   * @param list<string> $columns
   * @param callable(string): string $transform
   */
  private function transformTokens(string $tableName, array $columns, callable $transform):void {
    DB::table($tableName)->select(['id', ...$columns])->orderBy('id')->chunkById(500, function ($rows) use ($tableName, $columns, $transform) {
      foreach ($rows as $row){
        $changes = [];
        foreach ($columns as $column){
          if ($row->$column !== null){
            $transformed = $transform($row->$column);
            if ($transformed !== $row->$column){
              $changes[$column] = $transformed;
            }
          }
        }
        if ($changes !== []){
          DB::table($tableName)->where('id', $row->id)->update($changes);
        }
      }
    });
  }
};
