<?php

namespace Tests\Feature;

use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\TelemetryUsage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\Support\CreatesApiFixtures;
use Tests\TestCase;

class TelemetryUsageBySourceTest extends TestCase {
  use DatabaseTransactions, CreatesApiFixtures;

  /**
   * @return array{0: BotCommand, 1: BotCommandOption}
   */
  private function commandWithRuns():array {
    $command = $this->createBotCommand('testcmd', ['hour']);
    $option = $command->options()->firstOrFail();
    foreach (['discord-bot', 'discord-bot', 'api', 'mcp', 'mcp', 'mcp'] as $source){
      $command->telemetryExecutions()->create(['source' => $source]);
    }
    foreach (['discord-bot', 'api', 'api'] as $source){
      $option->telemetryUses()->create(['source' => $source]);
    }

    return [$command, $option];
  }

  /**
   * @return array<string, int> The values by source
   */
  private function usageBySource(BotCommand|BotCommandOption $source):array {
    return TelemetryUsage::where('source_id', (string)$source->getKey())->where('source_type', $source::class)->pluck('value', 'source')->map(fn($value) => (int)$value)->all();
  }

  public function test_the_daily_usage_is_counted_per_source_for_commands_and_options():void {
    [$command, $option] = $this->commandWithRuns();

    Artisan::call('app:calculate-telemetry-usage');

    $this->assertEquals(['discord-bot' => 2, 'api' => 1, 'mcp' => 3], $this->usageBySource($command));
    $this->assertEquals(['discord-bot' => 1, 'api' => 2], $this->usageBySource($option));
  }

  public function test_the_totals_stay_shared_across_the_sources():void {
    [$command, $option] = $this->commandWithRuns();

    Artisan::call('app:update-bot-command-total-executions');
    Artisan::call('app:update-bot-command-option-total-uses');

    $this->assertSame(6, $command->fresh()->total_executions);
    $this->assertSame(3, $option->fresh()->total_uses);
  }

  public function test_what_was_recorded_before_there_was_a_source_counts_as_the_bots(): void {
    $command = $this->createBotCommand('testcmd', ['hour']);
    $option = $command->options()->firstOrFail();
    // Rows made by the release before this one, which does not set a source
    $command->telemetryExecutions()->create();
    $option->telemetryUses()->create();

    $this->assertSame('discord-bot', $command->telemetryExecutions()->firstOrFail()->fresh()->source);
    $this->assertSame('discord-bot', $option->telemetryUses()->firstOrFail()->fresh()->source);
  }

  public function test_the_usage_endpoint_tells_which_source_each_value_is_from():void {
    [$command] = $this->commandWithRuns();
    Artisan::call('app:calculate-telemetry-usage');

    $response = $this->getJson('/frontend/app-usage?type=command&id='.$command->id)->assertOk();

    $this->assertEqualsCanonicalizing(
      ['discord-bot' => 2, 'api' => 1, 'mcp' => 3],
      collect($response->json())->pluck('value', 'source')->all(),
    );
    $response->assertJsonStructure([['date', 'value', 'source']]);
  }
}
