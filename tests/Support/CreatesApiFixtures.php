<?php

namespace Tests\Support;

use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\DiscordUser;
use App\Models\User;
use App\Services\Discord\DiscordUserService;
use Illuminate\Support\Str;

trait CreatesApiFixtures {
  /** @var list<DiscordUser> */
  private array $createdDiscordUsers = [];

  protected function createUser(string $name = 'Test user'):User {
    return User::create(['name' => $name]);
  }

  protected function createDiscordUser(?User $user = null, ?int $id = null):DiscordUser {
    $discordUser = DiscordUser::create([
      'id' => $id ?? random_int(100_000_000_000_000_000, 900_000_000_000_000_000),
      'name' => 'tester'.Str::random(5),
      'discriminator' => '0',
      'user_id' => $user?->id,
    ]);
    $this->createdDiscordUsers[] = $discordUser;

    return $discordUser;
  }

  /**
   * @param list<string> $optionNames
   */
  protected function createBotCommand(string $name = 'testcmd', array $optionNames = []):BotCommand {
    $command = BotCommand::create(['id' => random_int(100_000_000_000_000_000, 900_000_000_000_000_000), 'name' => $name, 'type' => 1]);
    foreach ($optionNames as $i => $optionName){
      BotCommandOption::create(['bot_command_id' => $command->id, 'name' => $optionName, 'type' => 3, 'order' => $i]);
    }

    return $command;
  }

  /**
   * The settings cache lives in Redis, which the transaction rollback does not reach
   */
  protected function forgetCreatedDiscordUsersSettings():void {
    foreach ($this->createdDiscordUsers as $discordUser){
      app(DiscordUserService::class)->clearSettingsCache($discordUser);
    }
    $this->createdDiscordUsers = [];
  }
}
