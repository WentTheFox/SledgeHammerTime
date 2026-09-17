<?php

namespace App\Console\Commands;

use App\Services\Discord\DiscordApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

class UpdateTopGgStatistics extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:update-topgg-stats';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update bot statistics on the Top.gg tracking service';

  public function __construct(protected DiscordApiService $discordApiService) {
    parent::__construct();
  }

  /**
   * Execute the console command.
   */
  public function handle():int {
    $token = config('services.top-gg.token');
    if (empty($token)){
      $this->warn("You do not have a Top.gg token set, which is required to use this command.");

      return 1;
    }

    $statsData = [
      'server_count' => $this->discordApiService->getApproximateGuildCount(),
    ];
    $this->info("Updating Top.gg bot stats…\n".var_export($statsData, return: true));

    $endpoint = sprintf("/bots/%s/stats", config('services.discord.client_id'));
    /**
     * @var ResponseInterface $result
     */
    $result = Http::asJson()
      ->baseUrl(config('services.top-gg.base_url'))
      ->withHeaders([
        'Authorization' => $token,
      ])
      ->post($endpoint, $statsData);

    $statusCode = $result->getStatusCode();
    if ($statusCode !== 200){
      $this->fail(implode("\n", [
        "Failed to update bot stats on Top.gg, got HTTP $statusCode",
        "Response headers:",
        var_export($result->getHeaders(), return: true),
        "Response body:",
        $result->getBody(),
      ]));
    }

    $this->info('Bot stats on Top.gg updated successfully');

    return 0;
  }
}
