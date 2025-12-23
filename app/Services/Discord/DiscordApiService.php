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
}
