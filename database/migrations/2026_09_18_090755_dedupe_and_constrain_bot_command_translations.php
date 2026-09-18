<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up():void {
    // syncLocalizations (BotApiController) had no DB-level uniqueness on its natural key
    // (command_id, option_id, choice_id, locale, field), only an application-side preload
    // check - so two overlapping requests (e.g. a bot deploy client retrying this endpoint
    // after a timeout while the first, slow, request was still running) could both decide a
    // row didn't exist yet and both insert it. Over many deploys this produced up to ~120
    // exact duplicates of the same translation. Keep one arbitrary survivor per key group -
    // duplicates found to differ in value are stale copies the next sync will correct anyway,
    // since the bot's payload (not this table) is the source of truth.
    DB::statement(<<<'SQL'
      DELETE FROM bot_command_translations t
      USING (
        SELECT id, ROW_NUMBER() OVER (
          PARTITION BY command_id, option_id, choice_id, locale, field
          ORDER BY id
        ) AS rn
        FROM bot_command_translations
      ) ranked
      WHERE t.id = ranked.id AND ranked.rn > 1
    SQL);

    // Matches every other UUID-primary-keyed table in this app (see User, WebhookDelivery,
    // etc.) - this table predates that convention.
    DB::statement('ALTER TABLE bot_command_translations ALTER COLUMN id SET DEFAULT gen_random_uuid()');

    // Makes the race described above structurally impossible going forward: syncLocalizations
    // now upserts against this constraint instead of preload-then-insert. NULLS NOT DISTINCT
    // is required because option_id/choice_id are nullable for command- and option-level
    // (as opposed to choice-level) translations, and a plain UNIQUE index treats every NULL
    // as distinct from every other NULL.
    Schema::table('bot_command_translations', function (Blueprint $table) {
      $table->unique(['command_id', 'option_id', 'choice_id', 'locale', 'field'], 'bot_command_translations_natural_key')
        ->nullsNotDistinct();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down():void {
    Schema::table('bot_command_translations', function (Blueprint $table) {
      $table->dropUnique('bot_command_translations_natural_key');
    });

    DB::statement('ALTER TABLE bot_command_translations ALTER COLUMN id DROP DEFAULT');

    // Deleted duplicate rows are not restored.
  }
};
