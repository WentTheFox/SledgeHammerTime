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
    return self::isConfigured() || File::exists(self::path());
  }

  /**
   * Set through APP_READ_ONLY for longer periods (e.g. a server cutover), as opposed to the short deploy-window
   * file flag. Rejected writes carry no Retry-After in this case, so clients do not sit in retry loops.
   */
  public static function isConfigured():bool {
    return (bool) config('app.read_only');
  }

  public static function enable():void {
    File::put(self::path(), (string) time());
  }

  public static function disable():void {
    File::delete(self::path());
  }
}
