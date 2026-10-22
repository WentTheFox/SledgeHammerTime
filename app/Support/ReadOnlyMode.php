<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

/**
 * Deploy-window flag: while set, the app serves reads but rejects writes, so new code can go
 * live before its migrations have been applied. Stored as a file so it survives across
 * requests/workers and does not need the database (which is the thing being migrated).
 */
class ReadOnlyMode {
  public const RETRY_AFTER_SECONDS = 5;

  public static function path():string {
    return storage_path('framework/readonly');
  }

  public static function isActive():bool {
    return File::exists(self::path());
  }

  public static function enable():void {
    File::put(self::path(), (string) time());
  }

  public static function disable():void {
    File::delete(self::path());
  }
}
