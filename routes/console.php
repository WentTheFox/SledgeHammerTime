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
use App\Console\Commands\UpdateBotCommandOptionTotalUses;
use App\Console\Commands\UpdateBotCommandTotalExecutions;
use App\Console\Commands\UpdateDiscordBotListCommands;
use App\Console\Commands\UpdateDiscordBotListStatistics;
use App\Console\Commands\UpdateTopGgStatistics;

Schedule::command(UpdateTopGgStatistics::class)->hourly();
Schedule::command(UpdateDiscordBotListStatistics::class)->hourly();
Schedule::command(UpdateDiscordBotListCommands::class)->daily();
Schedule::command(UpdateBotCommandTotalExecutions::class)->hourly();
Schedule::command(UpdateBotCommandOptionTotalUses::class)->hourly();
Schedule::command(CalculateTelemetryUsage::class)->hourly();
