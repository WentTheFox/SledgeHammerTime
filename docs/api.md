# Public API and MCP server

The public REST API and the MCP server are a separate Node service (`packages/api` in the HammerTimeBot repository).
This app is its system of record: it owns the users, the API keys, the bot settings and the command telemetry, and the
service reaches them through the `/internal` endpoints below. Nothing else may call those.

## API keys

- Users create and revoke keys on their profile page (`ApiKeyController`, `Pages/Profile/Partials/ApiKeys.vue`).
- A key is a Sanctum token (`App\Models\PersonalAccessToken`) bound to **one** linked Discord account
  (`personal_access_tokens.discord_user_id`) whose scopes (`App\Enums\ApiKeyScope`) are the abilities of the token:
  `timestamps:create`, `settings:read`, `settings:write`. Keys start with `htk_` so secret scanners can find them,
  only a hash is stored, and the plain key is shown once.
- `ApiKeyService::validate()` is the only place that decides whether a presented key is good. A key stops working
  when it expires, is revoked, or when its Discord account is no longer linked to the user who created it.
- The bot has a different kind of key, issued with `php artisan bot-token:generate --service`. It carries the
  `act-as-discord-user` ability, so the API service lets it act on behalf of whichever account it names, but only to
  run commands. The existing plain `bot-token:generate` token is **not** an API key.

## Internal endpoints

`routes/internal.php`, behind `InternalServiceMiddleware`. They are not part of the throttled `api` group on purpose.

| Endpoint | Purpose |
| --- | --- |
| `POST /internal/keys/validate` `{token}` | The account and scopes of a key, 401 if it is not valid. Exempt from the read-only window since it only reads. |
| `GET /internal/settings/{discordUserId}` | The settings with defaults, the same as what the bot reads. |
| `PATCH /internal/settings/{discordUserId}` | Changes only the given settings, `null` resets one. Same rules as the settings page. |
| `POST /internal/command-telemetry` | Records a run by command name with its source (`discord-bot`, `api`, `mcp`). |

## Configuration

- `INTERNAL_API_SECRET` in `.env` (see `.env.example`), the same value the API service has. Generate one with
  `openssl rand -hex 32`. Without it every internal endpoint answers 500. In a zero-downtime setup `.env` is shared
  between releases, so it only has to be set once.
- Restrict `/internal` in nginx so only the API service can reach it. The secret is checked either way, this is a
  second lock. The nginx config is not part of this repository:

  ```nginx
  location ^~ /internal/ {
      allow 127.0.0.1;
      deny all;
      try_files $uri /index.php?$query_string;
  }
  ```

  This is a template, adapt it to the real server block. `try_files` sends the request on to `/index.php`, where your
  existing PHP `location` handles it like any other route, so nothing from that block has to be repeated here. Change
  `allow` if the API service runs on another host, and check with `curl -i https://<host>/internal/settings/1` from
  outside: it must be refused by nginx (403), not answer 401 from the app.
- The beta copy shares production's database through a read-only role. Leave `INTERNAL_API_SECRET` unset there, so
  its internal endpoints stay unusable.

## Deploying

1. Deploy this app first. Its migrations add a nullable column and a defaulted one, so they follow the expand-only
   rule in `zero-downtime-deploy.md`.
   The same release also repairs id sequences that are behind their table (`PostgresSequences`, run by a migration):
   production's `personal_access_tokens` was restored with ids of its own, so creating any token failed with a duplicate
   key. It only moves a sequence forward, does nothing where they are fine, and skips (and logs) whatever it can not
   repair, so it can not hold up a deploy.
2. Only then deploy the API service, which calls these endpoints. During the short read-only window key validation and
   settings reads keep working, settings changes and telemetry get `503` + `Retry-After`, which the API service passes on
   to its clients (and skips telemetry for).
3. Issue the bot's service key with `php artisan bot-token:generate --service` when the bot is switched over to the
   API service (see the HammerTimeBot repository).

## Tests

`tests/Feature/InternalApiTest.php`, `ApiKeyManagementTest.php`, `BotTokenCommandTest.php`. They use the local
database inside a transaction and need Redis (the settings cache).
