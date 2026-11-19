# Zero-downtime deploys

New code goes live **before** its migrations run (the Argo CD sync does the migrate step). While `migrate` runs
the app is in *read-only mode*: pages and read APIs keep working, writes get `503` + `Retry-After`.

## Read-only mode

- `app/Support/ReadOnlyMode.php` (file flag), `php artisan app:readonly on|off|status`.
- `BlockWritesInReadOnlyMode` (global middleware): non-safe methods, plus GET routes that write
  (`bot-login/*`, `oauth/callback*`) → 503.
- `TrackPageViews` skips recording while the flag is set (it writes the newest schema's columns).
- When adding a GET route that writes to the DB, add it to `WRITING_GET_PATTERNS`.
- `Retry-After` is `ReadOnlyMode::RETRY_AFTER_SECONDS` (5 s, a deploy's window is 5-8 s).
- Frontend: `resources/js/utils/read-only-retry.ts` wraps Inertia's HTTP client (`createInertiaApp({ http })` in
  `app.ts`). A 503 that carries `Retry-After` is sent again after that wait (at least 1 s, at most 10 s, plus up to 1 s
  jitter), up to 3 times, so a form just stays "processing" until the window is over. Safe for writes because the
  server refuses them before any handler runs. After the retries the error reaches Inertia as before (dialog).
  Covered by `read-only-retry.test.ts` and `tests/Browser/ReadOnlyRetryTest.php`.

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
