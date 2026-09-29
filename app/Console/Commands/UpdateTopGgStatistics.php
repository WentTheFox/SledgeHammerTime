<?php

namespace App\Console\Commands;

use App\Services\Discord\DiscordApiService;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
    $result = Http::asJson()
      ->baseUrl(config('services.top-gg.base_url'))
      ->withHeaders([
        'Authorization' => $token,
      ])
      ->timeout(15)
      ->retry(
        3,
        2000,
        fn(\Throwable $e) => $e instanceof ConnectionException
          || ($e instanceof RequestException && ($e->response->status() === 429 || $e->response->serverError())),
        throw: false,
      )
      ->post($endpoint, $statsData);

    $statusCode = $result->status();
    if ($statusCode !== 200){
      $message = implode("\n", [
        "Failed to update bot stats on Top.gg, got HTTP $statusCode",
        "Response headers:",
        var_export($result->headers(), return: true),
        "Response body:",
        $result->body(),
      ]);
      // The scheduler discards console output, so record the failure in the log
      Log::error($message);
      $this->fail($message);
    }

    $this->info('Bot stats on Top.gg updated successfully');

    return 0;
  }
}
