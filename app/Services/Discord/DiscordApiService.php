<?php

declare(strict_types=1);

namespace App\Services\Discord;

use Illuminate\Container\Attributes\Singleton;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

#[Singleton]
class DiscordApiService {
  protected function createPendingRequest():PendingRequest {
    return Http::asJson()
      ->baseUrl(config('services.discord.base_url'))
      ->withHeaders([
        'Authorization' => sprintf('Bot %s', config('services.discord.bot_token')),
        'Accept' => 'application/json',
      ]);
  }

  public function getUser(string $id):GetUserResponse {
    $response = $this->createPendingRequest()->get(sprintf('/users/%s', $id));

    return GetUserResponse::fromResponse($response);
  }

  /**
   * The app's approximate server count, as reported by Discord itself. Used instead of a
   * bot-pushed shard stats table so it stays correct regardless of how the bot is deployed
   * (webhook mode has no gateway/shard connection to count guilds from locally).
   */
  public function getApproximateGuildCount():int {
    $response = $this->createPendingRequest()->get('/applications/@me')->throw();

    return (int)$response->json('approximate_guild_count');
  }
}
