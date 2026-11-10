<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * A plain `timestamp` column stores the app's wall clock without saying which time zone that was, so changing
 * APP_TIMEZONE silently shifts what is already stored. Use timestampsTz()/timestampTz()/dateTimeTz() instead.
 */
class TimestampColumnsTest extends TestCase {
  use RefreshDatabase;

  public function test_no_table_has_a_timestamp_column_without_a_time_zone():void {
    $columns = DB::table('information_schema.columns')
      ->where('table_schema', 'public')
      ->where('data_type', 'timestamp without time zone')
      ->orderBy('table_name')
      ->orderBy('column_name')
      ->get(['table_name', 'column_name'])
      ->map(fn($column) => "$column->table_name.$column->column_name")
      ->all();

    $this->assertSame([], $columns, 'Use the Tz variants (timestampsTz(), timestampTz(), dateTimeTz()) for these columns');
  }

  public function test_the_connection_session_uses_the_app_timezone():void {
    $this->assertSame(config('app.timezone'), DB::selectOne('show timezone')->TimeZone);
  }
}
