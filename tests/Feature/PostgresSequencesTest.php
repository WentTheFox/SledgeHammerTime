<?php

namespace Tests\Feature;

use App\Support\PostgresSequences;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class PostgresSequencesTest extends TestCase {
  use DatabaseTransactions;

  private string $schema;

  protected function setUp():void {
    parent::setUp();

    if (DB::getDriverName() !== 'pgsql'){
      $this->markTestSkipped('Sequences are a Postgres thing.');
    }
    // Temporary tables are gone with the transaction and the connection, so nothing real is touched
    // (a sequence is not rolled back, which would otherwise leave a mark on the real tables)
    DB::statement('CREATE TEMPORARY TABLE sequence_test (id bigserial PRIMARY KEY, label text)');
    DB::statement('CREATE TEMPORARY TABLE sequence_test_empty (id bigserial PRIMARY KEY)');
    DB::statement('CREATE TEMPORARY TABLE sequence_test_uuid (id uuid PRIMARY KEY DEFAULT gen_random_uuid())');
    $this->schema = DB::selectOne('SELECT nspname FROM pg_namespace WHERE oid = pg_my_temp_schema()')->nspname;
  }

  private function insertWithoutId(string $table = 'sequence_test'):int {
    return (int)DB::selectOne("INSERT INTO $table DEFAULT VALUES RETURNING id")->id;
  }

  public function test_the_sequence_that_is_behind_is_the_reason_inserts_fail():void {
    DB::table('sequence_test')->insert([['id' => 1], ['id' => 2]]);

    $this->expectException(\Illuminate\Database\QueryException::class);
    $this->expectExceptionMessage('duplicate key');

    // Exactly what production did: the sequence still starts at 1
    $this->insertWithoutId();
  }

  public function test_it_moves_a_sequence_that_is_behind_to_the_highest_id():void {
    DB::table('sequence_test')->insert([['id' => 1], ['id' => 2], ['id' => 7]]);

    $advanced = PostgresSequences::advanceBehind($this->schema);

    $this->assertSame(['sequence_test.id'], $advanced);
    $this->assertSame(8, $this->insertWithoutId());
  }

  public function test_it_never_moves_a_sequence_back_so_deleted_ids_are_not_reused():void {
    $this->insertWithoutId();
    $this->insertWithoutId();
    $last = $this->insertWithoutId();
    DB::table('sequence_test')->where('id', '>', 1)->delete();

    // The table now ends at 1 while the sequence has handed out 3
    $this->assertSame([], PostgresSequences::advanceBehind($this->schema));
    $this->assertSame($last + 1, $this->insertWithoutId());
  }

  public function test_it_leaves_an_empty_table_and_a_fresh_sequence_alone():void {
    $this->assertSame([], PostgresSequences::advanceBehind($this->schema));
    $this->assertSame(1, $this->insertWithoutId('sequence_test_empty'));
  }

  public function test_it_changes_nothing_that_is_fine_and_can_be_run_again():void {
    DB::table('sequence_test')->insert([['id' => 5]]);

    $this->assertSame(['sequence_test.id'], PostgresSequences::advanceBehind($this->schema));
    $this->assertSame([], PostgresSequences::advanceBehind($this->schema));
    $this->assertSame(6, $this->insertWithoutId());
  }

  public function test_it_ignores_columns_that_have_no_sequence():void {
    DB::statement('INSERT INTO sequence_test_uuid DEFAULT VALUES');

    $this->assertSame([], PostgresSequences::advanceBehind($this->schema));
  }

  public function test_it_skips_what_it_cannot_repair_instead_of_failing_and_repairs_the_rest():void {
    DB::table('sequence_test')->insert([['id' => 3]]);
    // A sequence that cannot reach the highest id, so setval is refused
    DB::statement('CREATE TEMPORARY TABLE sequence_test_capped (id integer PRIMARY KEY)');
    DB::statement('CREATE TEMPORARY SEQUENCE sequence_test_capped_seq MAXVALUE 5 OWNED BY sequence_test_capped.id');
    DB::statement('INSERT INTO sequence_test_capped (id) VALUES (7)');
    Log::spy();

    $advanced = PostgresSequences::advanceBehind($this->schema);

    $this->assertSame(['sequence_test.id'], $advanced, 'What can be repaired still is');
    Log::shouldHaveReceived('warning')->once()->withArgs(fn(string $message) => str_contains($message, 'sequence_test_capped.id'));
    $this->assertSame(4, $this->insertWithoutId(), 'And the transaction of the migration is still usable');
  }

  public function test_the_real_database_has_no_sequence_behind_once_the_migration_has_run():void {
    // Skipped quietly when the test database is not the development one, which may legitimately be behind
    $this->assertSame([], PostgresSequences::advanceBehind('public'));
  }
}
