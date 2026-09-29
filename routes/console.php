<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

use App\Console\Commands\CalculateTelemetryUsage;
use App\Console\Commands\CompressPageViews;
use App\Console\Commands\CompressWebhookDeliveries;
use App\Console\Commands\UpdateBotCommandOptionTotalUses;
use App\Console\Commands\UpdateBotCommandTotalExecutions;
use App\Console\Commands\UpdateDiscordBotListCommands;
use App\Console\Commands\UpdateDiscordBotListStatistics;
use App\Console\Commands\UpdateTopGgStatistics;

Schedule::command('horizon:snapshot')->everyFiveMinutes();

// Bot list reporting only runs where the tokens are configured (i.e. not on beta)
Schedule::command(UpdateTopGgStatistics::class)
  ->hourly()
  ->when(fn() => !empty(config('services.top-gg.token')));
Schedule::command(UpdateDiscordBotListStatistics::class)
  ->hourly()
  ->when(fn() => !empty(config('services.discord-bot-list.token')) && !empty(config('services.discord-bot-list.bot_id')));
Schedule::command(UpdateDiscordBotListCommands::class)
  ->daily()
  ->when(fn() => !empty(config('services.discord-bot-list.token')) && !empty(config('services.discord-bot-list.bot_id')));
Schedule::command(UpdateBotCommandTotalExecutions::class)->hourly();
Schedule::command(UpdateBotCommandOptionTotalUses::class)->hourly();
Schedule::command(CalculateTelemetryUsage::class)->hourly();
Schedule::command(CompressPageViews::class)->daily();
Schedule::command(CompressWebhookDeliveries::class)->daily();
