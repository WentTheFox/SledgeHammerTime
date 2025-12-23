<?php

namespace App\Http\Controllers;

use App\Enums\DiscordTimestampFormat;
use App\Enums\TimestampMessageColumns;
use App\Http\Requests\BotSettingsUpdate;
use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\BotCommandOptionChoice;
use App\Models\BotCommandTranslation;
use App\Models\DiscordUser;
use App\Models\Settings;
use App\Services\Discord\DiscordUserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BotSettingsController extends Controller {
  public function __construct(protected DiscordUserService $discordUserService) { }

  function edit() {
    $userSettings = Auth::user()?->discordUsers()->get()->map(fn(DiscordUser $du) => [
      'user' => $du->mapToUiInfo(),
      'settings' => $this->discordUserService->getSettingsRecord($du, cache: false),
    ]);

    return Inertia::render('Settings/IndexComponent', [
      'userSettings' => $userSettings ?? [],
      'defaultSettings' => Settings::mergeWithDefaults([]),
      'formatOptions' => array_map(static fn($x) => $x->value, DiscordTimestampFormat::cases()),
      'columnsOptions' => array_map(static fn($x) => $x->value, TimestampMessageColumns::cases()),
      'botTranslations' => $this->getBotTranslations(),
    ]);
  }

  function set(BotSettingsUpdate $request) {
    $data = $request->validated();

    $discordUserId = $request->route('discordUserId');
    $discordUser = DiscordUser::findOrFail($discordUserId);

    /** @var Settings[] $currentSettings */
    $currentSettings = $discordUser->settings()->get();
    DB::transaction(function () use ($discordUser, $data, $currentSettings) {
      foreach ($currentSettings as $setting){
        $shouldDelete = !isset($data[$setting->setting]);
        /** @var Settings $setting */
        if (!$shouldDelete && Settings::shouldDeleteIfMatchingDefault($setting->setting, $data[$setting->setting])){
          $shouldDelete = true;
          unset($data[$setting->setting]);
        }
        if ($shouldDelete){
          $setting->delete();
        }
        else {
          $setting->value = $data[$setting->setting];
          $setting->save();
        }
        unset($data[$setting->setting]);
      }

      $newSettingData = [];
      foreach ($data as $settingName => $value){
        if (Settings::shouldDeleteIfMatchingDefault($settingName, $value))
          continue;
        $newSettingData[] = ['setting' => $settingName, 'value' => $value];
      }
      $discordUser->settings()->createMany($newSettingData);
    });

    $this->discordUserService->clearSettingsCache($discordUser);

    return response()->noContent(200);
  }

  private function getBotTranslations():array {
    $commandNameToIdMap = (array)BotCommand::whereIn('name', ['at', 'at12'])
      ->get()
      ->reduce(fn(array $acc, BotCommand $command) => [...$acc, $command->name => $command->id], []);
    $commandIds = array_values($commandNameToIdMap);
    $commandNameTranslations = BotCommandTranslation::where('locale', App::getLocale())
      ->whereIn('command_id', $commandIds)
      ->whereNull('option_id')
      ->where('field', 'name')
      ->get();
    $optionNameToIdMap = (array)BotCommandOption::whereIn('bot_command_id', $commandIds)
      ->whereIn('name', ['hour', 'minute', 'second', 'format', 'columns'])
      ->get()
      ->reduce(fn(array $acc, BotCommandOption $option) => [...$acc, $option->name => $option->id], []);
    $optionIds = array_values($optionNameToIdMap);
    $optionChoiceById = (array)BotCommandOptionChoice::whereIn('bot_command_option_id', [$optionNameToIdMap['format'], $optionNameToIdMap['columns']])
      ->get()
      ->reduce(fn(array $acc, BotCommandOptionChoice $choice) => [...$acc, $choice->id => $choice], []);
    $optionNameTranslations = BotCommandTranslation::where('locale', App::getLocale())
      ->whereIn('command_id', $commandIds)
      ->whereIn('option_id', $optionIds)
      ->where('field', 'name')
      ->get();

    $result = [
      'atCommandName' => 'at',
      'at12CommandName' => 'at12',
      'hourOptionName' => 'hour',
      'minuteOptionName' => 'minute',
      'secondOptionName' => 'second',
      'formatOptionChoices' => [],
      'columnsOptionChoices' => [],
    ];
    foreach ($commandNameTranslations as $commandNameTranslation){
      switch ($commandNameTranslation->command_id){
        case $commandNameToIdMap['at']:
          $result['atCommandName'] = $commandNameTranslation->value;
        break;
        case $commandNameToIdMap['at12']:
          $result['at12CommandName'] = $commandNameTranslation->value;
        break;
      }
    }
    foreach ($optionNameTranslations as $optionNameTranslation){
      switch ($optionNameTranslation->option_id){
        case $optionNameToIdMap['hour']:
          $result['hourOptionName'] = $optionNameTranslation->value;
        break;
        case $optionNameToIdMap['minute']:
          $result['minuteOptionName'] = $optionNameTranslation->value;
        break;
        case $optionNameToIdMap['second']:
          $result['secondOptionName'] = $optionNameTranslation->value;
        break;
        case $optionNameToIdMap['format']:
          if ($optionNameTranslation->choice_id !== null){
            $result['formatOptionChoices'][$optionChoiceById[$optionNameTranslation->choice_id]->value] = $optionNameTranslation->value;
          }
        break;
        case $optionNameToIdMap['columns']:
          if ($optionNameTranslation->choice_id !== null && array_key_exists($optionNameTranslation->choice_id, $optionChoiceById)){
            $result['columnsOptionChoices'][$optionChoiceById[$optionNameTranslation->choice_id]->value] = $optionNameTranslation->value;
          }
        break;
      }
    }
    foreach ($optionChoiceById as $optionChoice){
      switch ($optionChoice->bot_command_option_id){
        case $optionNameToIdMap['format']:
          $result['formatOptionChoices'][$optionChoice->value] ??= $optionChoice->name;
        break;
        case $optionNameToIdMap['columns']:
          $result['columnsOptionChoices'][$optionChoice->value] ??= $optionChoice->name;
        break;
      }
    }

    return $result;
  }
}
