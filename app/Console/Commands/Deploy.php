<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\DownCommand;
use Illuminate\Foundation\Console\UpCommand;

class Deploy extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:deploy';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Deploy the latest application version';

  const CMD_LARAVEL_MIGRATE = "php artisan migrate --force";
  const CMD_NPM_CLEAN_INSTALL = "npm ci";
  const CMD_NPM_BUILD = "npm run build";
  const CMD_LARAVEL_OPTIMIZE = "php artisan optimize";
  const CMD_PM2_RESTART = "pm2 restart pm2.json";

  /**
   * Execute the console command.
   */
  public function handle() {
    $this->runCommand(self::CMD_LARAVEL_OPTIMIZE, [], $this->output);
    $this->runCommand(self::CMD_LARAVEL_MIGRATE, ['force' => true], $this->output);
    $this->runCommand(self::CMD_NPM_CLEAN_INSTALL, [], $this->output);
    $this->runCommand(DownCommand::class, ['retry' => 5, 'refresh' => 5], $this->output);
    try {
      $this->runCommand(self::CMD_NPM_BUILD, [], $this->output);
    }
    catch (\Throwable $exception){
      $this->runCommand(UpCommand::class, [], $this->output);
      throw $exception;
    }
    $this->runCommand(self::CMD_PM2_RESTART, [], $this->output);
  }
}
