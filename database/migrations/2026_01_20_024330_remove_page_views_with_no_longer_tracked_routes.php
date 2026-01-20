<?php

use App\Models\PageView;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    PageView::whereIn('route_name', ['app.usage', 'app.ntp', 'app.localUserInfo'])->delete();
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    // noop
  }
};
