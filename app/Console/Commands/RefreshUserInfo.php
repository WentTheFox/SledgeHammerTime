<?php

namespace App\Console\Commands;

use App\Jobs\RefreshCrowdinUserInfo;
use App\Jobs\RefreshDiscordUserInfo;
use App\Services\Crowdin\CrowdinUserService;
use App\Services\Discord\DiscordUserService;
use Illuminate\Console\Command;

class RefreshUserInfo extends Command {
  public function __construct(
    protected CrowdinUserService $crowdinUserService,
    protected DiscordUserService $discordUserService,
  ) {
    parent::__construct();
  }

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:refresh-user-info {id} {provider} {--queue}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Execute the console command.
   */
  public function handle() {
    $id = $this->argument('id');
    $provider = $this->argument('provider');
    $queue = $this->option('queue');

    switch ($provider){
      case 'discord':
        if ($queue){
          RefreshDiscordUserInfo::dispatch($id);
        }
        else {
          $this->discordUserService->refreshUserInfo($id);
        }
      break;
      case 'crowdin':
        if ($queue){
          RefreshCrowdinUserInfo::dispatch($id);
        }
        else {
          $this->crowdinUserService->refreshUserInfo($id);
        }
      break;
      default:
        $this->error(sprintf("Unsupported provider %s", $provider));

        return 1;
    }

    return 0;
  }
}
