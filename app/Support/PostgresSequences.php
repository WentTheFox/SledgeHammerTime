<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Postgres hands out ids from a sequence that does not look at the table. A restore or an import that inserts rows
 * with ids of their own leaves it behind, and from then on every insert fails with a duplicate key until the
 * sequence has passed the highest id.
 */
class PostgresSequences {
  /**
   * Moves every sequence that is behind the highest id in its column forward to it, and none back (ids that were
   * deleted are not handed out again). A sequence that can not be moved is logged and skipped, since this is a repair
   * that must not be able to stop a deploy.
   *
   * @return list<string> The columns whose sequence was behind, as table.column
   */
  public static function advanceBehind(string $schema = 'public'):array {
    $grammar = DB::connection()->getQueryGrammar();
    $columns = DB::select(
      "SELECT c.table_name, c.column_name, pg_get_serial_sequence(quote_ident(c.table_schema) || '.' || quote_ident(c.table_name), c.column_name) AS sequence
       FROM information_schema.columns c
       JOIN information_schema.tables t ON t.table_schema = c.table_schema AND t.table_name = c.table_name
       WHERE c.table_schema = ? AND t.table_type IN ('BASE TABLE', 'LOCAL TEMPORARY')",
      [$schema],
    );

    $advanced = [];
    foreach ($columns as $column) {
      if ($column->sequence === null){
        continue;
      }

      try {
        // A savepoint of its own: after an error the transaction of the migration would otherwise be unusable
        $wasBehind = DB::transaction(function () use ($column, $schema, $grammar):bool {
          $highest = DB::selectOne("SELECT MAX({$grammar->wrap($column->column_name)}) AS highest FROM {$grammar->wrapTable("$schema.$column->table_name")}")->highest;
          if ($highest === null){
            return false;
          }
          $sequence = DB::selectOne("SELECT last_value, is_called FROM $column->sequence");
          $nextId = $sequence->is_called ? (int)$sequence->last_value + 1 : (int)$sequence->last_value;
          if ((int)$highest < $nextId){
            return false;
          }
          DB::selectOne('SELECT setval(?, ?, true)', [$column->sequence, (int)$highest]);

          return true;
        });
      }
      catch (Throwable $e) {
        Log::warning("Could not check the id sequence of $column->table_name.$column->column_name: {$e->getMessage()}");
        continue;
      }

      if ($wasBehind){
        $advanced[] = "$column->table_name.$column->column_name";
      }
    }

    return $advanced;
  }
}
