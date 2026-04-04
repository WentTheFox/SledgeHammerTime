<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RegisterCreditsWebhook extends Command {
  protected $signature = 'discord:register-credits-webhook
    {channel : The Discord channel ID to create the webhook in}
    {--name=Credit Override Notifications : Display name for the webhook}';

  protected $description = 'Register an application-owned Discord webhook for credit override notifications and save its URL to .env';

  public function handle():int {
    $botToken = config('services.discord.bot_token');
    if (!$botToken) {
      $this->error('DISCORD_BOT_TOKEN is not set.');

      return self::FAILURE;
    }

    $channelId = $this->argument('channel');
    $name = $this->option('name');

    $this->line("Creating webhook in channel <info>$channelId</info>...");

    $response = Http::asJson()
      ->withToken($botToken, 'Bot')
      ->post(config('services.discord.base_url') . "channels/$channelId/webhooks", [
        'name' => $name,
      ]);

    if (!$response->successful()) {
      $this->error("Discord API returned HTTP {$response->status()}: {$response->body()}");

      return self::FAILURE;
    }

    $data = $response->json();
    $webhookUrl = "https://discord.com/api/webhooks/{$data['id']}/{$data['token']}";

    $this->writeEnvValue('DISCORD_CREDITS_WEBHOOK_URL', $webhookUrl);

    $this->info("Webhook registered successfully.");
    $this->line("URL: <comment>$webhookUrl</comment>");

    return self::SUCCESS;
  }

  private function writeEnvValue(string $key, string $value):void {
    $envPath = base_path('.env');
    $envContent = file_get_contents($envPath);

    $escaped = preg_quote($key, '/');

    if (preg_match("/^{$escaped}=/m", $envContent)) {
      $envContent = preg_replace("/^{$escaped}=.*/m", "$key=$value", $envContent);
    } else {
      $envContent .= PHP_EOL . "$key=$value";
    }

    file_put_contents($envPath, $envContent);
  }
}
