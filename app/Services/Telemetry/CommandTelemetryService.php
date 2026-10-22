<?php

declare(strict_types=1);

namespace App\Services\Telemetry;

use App\Enums\TelemetrySource;
use App\Models\BotCommand;
use Illuminate\Container\Attributes\Singleton;
use Illuminate\Support\Facades\URL;

#[Singleton]
class CommandTelemetryService {
  /**
   * Records one run of a command, with the options that were used, and describes it for the reply.
   *
   * @param list<string> $optionNames The names of the options the user provided
   *
   * @return array{executionNumber: int, privacyPolicyUrl: string, commandName: string, commandId: string}
   */
  public function record(BotCommand $command, array $optionNames, TelemetrySource $source, string $locale):array {
    $command->telemetryExecutions()->create(['source' => $source->value]);

    foreach ($optionNames as $optionName){
      $option = $command->options()->where('name', $optionName)->whereNull('deleted_at')->first();
      $option?->telemetryUses()->create();
    }

    return [
      // Counts every source, so a command's run count is the same wherever it is shown
      'executionNumber' => $command->telemetryExecutions()->count(),
      'privacyPolicyUrl' => URL::route('legal', ['locale' => $locale]).'#telemetry-statistics',
      'commandName' => $command->name,
      'commandId' => (string)$command->id,
    ];
  }
}
