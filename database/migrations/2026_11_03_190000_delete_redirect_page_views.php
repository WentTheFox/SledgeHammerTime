<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * "login" is only a redirect to the OAuth provider and "root" a redirect to the localized home page, so
   * neither is a page and they are no longer tracked. The "login" rows recorded so far were counting clicks
   * on login links, not page views, and "root" is never recorded in the first place (the locale redirect
   * happens before the tracking middleware runs), so deleting it is just a safeguard.
   */
  public function up():void {
    DB::table('page_views')->whereIn('route_name', ['login', 'root'])->delete();
  }

  /**
   * Reverse the migrations.
   *
   * The deleted rows cannot be restored.
   */
  public function down():void {
  }
};
