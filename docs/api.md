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
- `/internal` must not be reachable from the internet, and the API service calls it from the same machine. Behind
  Cloudflare an `allow` on an address is fragile (the public hostname loops out through Cloudflare and back), so the
  public site does not serve `/internal` at all and the API service uses a loopback-only listener of its own
  (`LARAVEL_URL=http://127.0.0.1:8088` in its `.env.api`). The nginx config is not part of this repository, this is
  what goes into it:

  ```nginx
  # In the public vhost (hammertime.cyou), before `location /`
  location ^~ /internal/ {
      return 404;
  }
  ```

  ```nginx
  # A new file in sites-enabled: the API service's way in, to this machine only, and only to /internal
  server {
      listen 127.0.0.1:8088;
      server_name _;
      root /var/www/SledgeHammerTime/public;
      error_log /var/www/SledgeHammerTime/storage/logs/nginx-error.log;

      location ^~ /internal/ {
          try_files $uri /index.php?$query_string;
      }
      location = /index.php {
          include fastcgi_params;
          fastcgi_pass unix:/var/run/php/php8.5-fpm.sock;
          fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
          fastcgi_read_timeout 15;
      }
      location / {
          return 404;
      }
  }
  ```

  Check from outside with `curl -i https://<host>/internal/settings/1`, which must be a 404 from nginx, and from the
  server with `curl -i http://127.0.0.1:8088/internal/settings/1`, which must be a 401 from the app (no secret).
  Links in the telemetry note are built from `APP_URL`, so the loopback address never ends up in front of users.
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
