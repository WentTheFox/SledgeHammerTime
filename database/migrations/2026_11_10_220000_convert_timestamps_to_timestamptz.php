<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  /**
   * The values these columns hold were written as the local wall clock of the time, which in production was always
   * Europe/Budapest (APP_TIMEZONE of the old server, and the database session timezone along with it), so that is the
   * zone a stored value is read in when it becomes an instant. Spelled out rather than taken from the session or
   * the app config, because the point of the migration is that those can differ.
   */
  private const string STORED_IN = 'Europe/Budapest';

  /**
   * Columns created by `timestamps()` and `timestamp()`, which are plain `timestamp` columns (no time zone).
   * Newer tables already use the Tz variants.
   *
   * @var array<string, list<string>>
   */
  private const array COLUMNS = [
    'bot_command_options' => ['created_at', 'updated_at'],
    'failed_jobs' => ['failed_at'],
    'faq_entries' => ['created_at', 'updated_at'],
    'personal_access_tokens' => ['created_at', 'updated_at', 'expires_at', 'last_used_at'],
    'translation_credit_override_proposals' => ['created_at', 'updated_at', 'rejected_at'],
    'translation_credit_overrides' => ['created_at', 'updated_at'],
    'translation_progress' => ['created_at', 'updated_at'],
    'translators' => ['created_at', 'updated_at'],
  ];

  /**
   * Run the migrations.
   */
  public function up():void {
    $this->convert('timestamp without time zone', 'timestamptz');
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    $this->convert('timestamp with time zone', 'timestamp(0) without time zone');
  }

  /**
   * Only touches the columns that are currently of the type being converted from, so it can be run again and is safe on
   * a database where the columns already are the target type. Each table is altered in a single statement so it is
   * rewritten once.
   */
  private function convert(string $from, string $to):void {
    if (DB::getDriverName() !== 'pgsql'){
      return;
    }

    // Altering a column type takes an exclusive lock on the table until the migration commits. The tables are small, so
    // this should be over in milliseconds, but if something holds a long lock fail instead of queueing every request
    // for the table (personal_access_tokens is read on each bot API request) behind the migration.
    DB::statement("set local lock_timeout = '10s'");

    foreach (self::COLUMNS as $table => $columns){
      $present = DB::table('information_schema.columns')
        ->where('table_schema', DB::raw('current_schema()'))
        ->where('table_name', $table)
        ->whereIn('column_name', $columns)
        ->where('data_type', $from)
        ->pluck('column_name')
        ->all();

      if ($present === []){
        continue;
      }

      $zone = self::STORED_IN;
      $alterations = array_map(
        fn(string $column) => "alter column \"$column\" type $to using \"$column\" at time zone '$zone'",
        $present,
      );
      DB::statement("alter table \"$table\" ".implode(', ', $alterations));
    }
  }
};
