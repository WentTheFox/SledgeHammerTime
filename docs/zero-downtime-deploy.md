# Zero-downtime deploys

New code goes live **before** its migrations run. Between the code swap and the end of `migrate`
the app is in *read-only mode*: pages and read APIs keep working, writes get `503` + `Retry-After`.

## Flow (git-deploy-toolkit `RELEASES=1`, see `deploy.conf`)

1. `deploy_build` (old release still serving): composer, `optimize`, `pnpm run build`
   (a failure aborts the deploy), then raise the flag `storage/framework/readonly`.
2. Toolkit swaps the `WORKTREE` symlink to the new release (reload php-fpm so opcache sees it).
3. `deploy_restart`: `migrate` (production only), Horizon + SSR restart, page-cache clear,
   `GET /status` health check (`Accept: application/json` returns DB + cache checks, 503 on failure; the HTML page is unchanged), then remove the flag.

If migrate or the health check fails the flag stays on. Roll back with the toolkit
(`git-deploy-rollback`) or fix forward, then run `php artisan app:readonly off`.
Without release dirs (`$RELEASE` equal to `$WORKTREE`, in-place mode) `deploy.conf` keeps the old `artisan down`/`up` flow.

Server requirements (all exercised in the local end-to-end run below):
- `SHARED=(.env storage setup/deploy-config.sh)`. `setup/deploy-config.sh` is untracked, so it must exist in
  `shared/setup/` (empty is fine) or every deploy fails before the swap. Convert with
  `git-deploy-releases-init <app> .env storage setup/deploy-config.sh`.
- sudoers for `systemctl reload <php-fpm unit>`, and `PHP_FPM_SERVICE` set in `setup/deploy-config.sh`.
- php-fpm: set `process_control_timeout` (e.g. `10s`) in the global section. Without it a graceful reload
  (`USR2`, what `systemctl reload` sends) resets the requests in flight (3 of ~1100 in the local run, none with it).
- Every release needs its own `node_modules` (pages inline FontAwesome CSS at request time), so
  `pnpm install` always runs in a fresh release.
- pm2/logrotate log paths in the shared dir.

## Read-only mode

- `app/Support/ReadOnlyMode.php` (file flag), `php artisan app:readonly on|off|status`.
- `BlockWritesInReadOnlyMode` (global middleware): non-safe methods, plus GET routes that write
  (`bot-login/*`, `oauth/callback*`) → 503.
- `TrackPageViews` skips recording while the flag is set (it writes the newest schema's columns).
- When adding a GET route that writes to the DB, add it to `WRITING_GET_PATTERNS`.

## Rules for migrations

Each release must run against the **previous** release's schema, and the previous release against
the new one (workers drain on old code). So migrations are expand-only: add nullable/defaulted
columns and new tables; drop or rename in a *later* release.

## Test

`php artisan test --group=deploy-window` reverts the migrations added since `DEPLOY_BASE_REF`
(default `origin/main`), enables read-only mode and checks reads stay < 500, writes get 503 and no
page view is recorded. A negative control proves the guard is what keeps `/en` alive. It only runs
against a database named `*_test` and skips when no migrations differ. Locally:

    DB_DATABASE=sledgehammertime_test DEPLOY_BASE_REF=<ref before your migration> php artisan test --group=deploy-window

## End-to-end run (local)

The whole flow was exercised locally with the real toolkit hook against a throwaway bare repo: nginx +
php-fpm on loopback ports (opcache with `validate_timestamps=0`, so only a reload shows new code), a separate
database, the real composer/artisan steps, and stubs for `sudo`, `systemctl`, `pm2` and the pnpm build. A
monitor polled three pages, `/status` (JSON) and a write on separate threads every 50 ms, and sampled the
symlink and the flag file, while release A (previous schema) was replaced by B (new code + a pending migration).

| Scenario | Reads | Writes | Flag |
| --- | --- | --- | --- |
| Normal deploy | 887 requests, 0 failed, longest gap 263 ms | 503 + `Retry-After` only on the new release, 1.6 s | on before the swap, off after the health check |
| Same deploy without the page-view guard (control) | 48 failed with 500 from the swap until migrate finished | 503 | as above |
| Migration fails | 0 failed | 503 until fixed | stays on, deploy recorded as `failed` |
| `git-deploy-rollback` afterwards | 0 failed | back to normal on the old release | stays on (inert on a release without the middleware) |
| Frontend build fails | 0 failed, old release untouched | unaffected | never raised, new release discarded |

Notes: `git push` itself exits 0 when the hook fails, so read `deploy.jsonl` (or the log) for the result.
After a rollback the flag stays on; remove `storage/framework/readonly` (or run `app:readonly off` from a release
that has the command) once the schema is known good.
