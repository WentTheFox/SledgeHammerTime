<?php

namespace App\Http\Controllers;

use App\Enums\BotInfoUsageType;
use App\Http\Requests\BotInfoUsageRequest;
use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\BotCommandTranslation;
use App\Models\BotShard;
use App\Models\TelemetryUsage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class BotInfoController extends Controller {
  public function index(): InertiaResponse {
    return Inertia::render('BotInfo/IndexComponent', [
      'discordAppId' => config('services.discord.client_id'),
      'commands' => BotCommand::with(['options' => ['choices']])->orderBy('type')->orderByRaw('total_executions IS NULL')->orderBy('total_executions', 'desc')->orderBy('name')->get(),
      'translations' => BotCommandTranslation::where('locale', App::getLocale())->get()
        ->map(fn(BotCommandTranslation $t) => $t->mapToUiInfo()),
    ]);
  }

  public function shards(): JsonResponse {
    return response()->json(
      BotShard::orderBy('id')->get()->map(fn(BotShard $s) => $s->mapToUiInfo()),
    );
  }

  public function usage(BotInfoUsageRequest $request): JsonResponse|Response {
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
