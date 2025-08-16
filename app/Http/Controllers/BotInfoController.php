<?php

namespace App\Http\Controllers;

use App\Enums\BotInfoUsageType;
use App\Http\Requests\BotInfoUsageRequest;
use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\BotCommandTranslation;
use App\Models\BotShard;
use App\Models\TelemetryUsage;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class BotInfoController extends Controller {
  public function index() {
    return Inertia::render('BotInfo/IndexComponent', [
      'discordAppId' => config('services.discord.client_id'),
      'commands' => BotCommand::with(['options' => ['choices']])->orderBy('type')->orderBy('total_executions', 'desc')->orderBy('name')->get(),
      'translations' => BotCommandTranslation::where('locale', App::getLocale())->get()
        ->map(fn(BotCommandTranslation $t) => $t->mapToUiInfo()),
      'shards' => BotShard::orderBy('id')->get()->map(fn(BotShard $t) => $t->mapToUiInfo()),
    ]);
  }

  public function usage(BotInfoUsageRequest $request) {
    $data = $request->validated();
    $type = match ($data['type']) {
      BotInfoUsageType::COMMAND->value => BotCommand::class,
      BotInfoUsageType::OPTION->value => BotCommandOption::class,
      default => null,
    };

    if ($type === null){
      return response(status: 404);
    }

    $usage = TelemetryUsage::where('source_id', $data['id'])->where('source_type', $type)->get();

    return response()->json($usage->map(fn(TelemetryUsage $item) => $item->mapToUiInfo()));
  }
}
