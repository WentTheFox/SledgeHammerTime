<?php

namespace Tests\Support;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

/**
 * Puts the database in the schema state of an older git ref (the release that is live before a
 * deploy) while the working tree holds the new code, i.e. the "code deployed, migrations pending" window.
 */
class SchemaAtRef {
  private const MIGRATIONS_DIR = 'database/migrations';

  /**
   * @return string[] migration names (without .php) present in the working tree but not at $ref, oldest first
   */
  public static function pendingSince(string $ref):array {
    $process = new Process(['git', 'ls-tree', '-r', '--name-only', $ref, self::MIGRATIONS_DIR], base_path());
    $process->mustRun();
    $atRef = array_map(
      fn(string $path) => basename($path, '.php'),
      array_filter(explode("\n", trim($process->getOutput())))
    );
    $current = array_map(
      fn(string $path) => basename($path, '.php'),
      glob(base_path(self::MIGRATIONS_DIR.'/*.php')) ?: []
    );
    $pending = array_values(array_diff($current, $atRef));
    sort($pending);

    return $pending;
  }

  /**
   * Reverts the given migrations (newest first). Calls down() directly instead of `migrate:rollback`,
   * which can only target the latest batch.
   *
   * @param string[] $migrations
   */
  public static function revert(array $migrations):void {
    /** @var Migrator $migrator */
    $migrator = app('migrator');
    $repository = $migrator->getRepository();
    $ran = $repository->getRan();
    foreach (array_reverse($migrations) as $name){
      if (!in_array($name, $ran, true)){
        continue;
      }
      // Anonymous-class migrations return the instance, named ones declare a class
      $migration = require base_path(self::MIGRATIONS_DIR."/$name.php");
      if (!is_object($migration)){
        $migration = $migrator->resolve($name);
      }
      $migration->down();
      $repository->delete((object) ['migration' => $name]);
    }
  }

  public static function migrateToHead():void {
    Artisan::call('migrate', ['--force' => true]);
  }
}
