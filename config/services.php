<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Third Party Services
  |--------------------------------------------------------------------------
  |
  | This file is for storing the credentials for third party services such
  | as Mailgun, Postmark, AWS and more. This file provides the de facto
  | location for this type of information, allowing packages to have
  | a conventional file to locate the various service credentials.
  |
  */

  'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
    'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    'scheme' => 'https',
  ],

  'postmark' => [
    'token' => env('POSTMARK_TOKEN'),
  ],

  'ses' => [
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
  ],

  'discord' => [
    'client_id' => env('DISCORD_CLIENT_ID'),
    'client_secret' => env('DISCORD_CLIENT_SECRET'),
    // Changed in controllers, but required in config
    'redirect' => 'https://example.com',
  ],

  'crowdin' => [
    'client_id' => env('CROWDIN_CLIENT_ID'),
    'client_secret' => env('CROWDIN_CLIENT_SECRET'),
    // Changed in controllers, but required in config
    'redirect' => 'https://example.com',
  ],

  'top-gg' => [
    'token' => env('TOP_GG_TOKEN'),
    'base_url' => 'https://top.gg/api',
  ],

  'discord-bot-list' => [
    'token' => env('DISCORD_BOT_LIST_TOKEN'),
    'base_url' => 'https://discordbotlist.com/api/v1',
    'bot_id' => env('DISCORD_BOT_LIST_BOT_ID'),
  ],
];
