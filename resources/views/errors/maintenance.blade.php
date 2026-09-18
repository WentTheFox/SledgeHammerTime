<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- No @vite() here on purpose: this view has to render correctly even while
       public/build is mid-swap during a deploy (Vite empties then rewrites it,
       so the manifest is briefly missing) - see BotInfo deploy incident 2026-09-18.
       Everything below (styles, auto-reload) is inlined for the same reason - a
       fallback that itself depends on a built asset defeats the point. --}}
  <noscript><meta http-equiv="refresh" content="10"></noscript>
  <title>{{ __('global.maintenanceMode.heading') }}</title>
  <style>
    :root {
      color-scheme: light dark;
      --bg: #fcfcfb;
      --fg: #1a1a19;
      --muted: #666;
      /* Same blurple as the app's primary buttons/links (see
         --ht-color-button-primary-bg-dark and --ht-color-content-link-light in
         resources/css/design/_common.scss) - used here for text/links/progress since
         the pale light-theme button bg (#c0c5fa) doesn't have enough contrast on its own. */
      --accent: #5865f2;
      --card-bg: #ffffff;
      --card-border: rgba(0, 0, 0, 0.1);
      --track-bg: rgba(0, 0, 0, 0.1);
      --button-bg: #c0c5fa;
      --button-border: #979ef0;
      --button-color: #000;
    }

    @media (prefers-color-scheme: dark) {
      :root {
        --bg: #1a1a19;
        --fg: #fcfcfb;
        --muted: #ccc;
        --card-bg: #262625;
        --card-border: rgba(255, 255, 255, 0.1);
        --track-bg: rgba(255, 255, 255, 0.1);
        --button-bg: #5865f2;
        --button-border: #3443e3;
        --button-color: #fff;
      }
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 16px;
      background: var(--bg);
      color: var(--fg);
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .card {
      max-width: 32rem;
      width: 100%;
      padding: 1.5rem;
      border: 1px solid var(--card-border);
      border-radius: 0.5rem;
      background: var(--card-bg);
    }

    h1 {
      margin: 0 0 0.75rem;
      font-size: 1.25rem;
      color: var(--accent);
    }

    p {
      margin: 0 0 0.75rem;
      line-height: 1.5;
      color: var(--muted);
    }

    a {
      color: var(--accent);
    }

    .progress-track {
      margin: 0.25rem 0 0.75rem;
      height: 0.375rem;
      border-radius: 0.25rem;
      background: var(--track-bg);
      overflow: hidden;
    }

    .progress-bar {
      height: 100%;
      width: 0;
      background: var(--accent);
      transition: width 0.2s linear;
    }

    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-top: 1rem;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.5rem 0.9rem;
      border-radius: 0.375rem;
      border: 1px solid var(--card-border);
      background: transparent;
      color: var(--fg);
      font-size: 0.9rem;
      font-family: inherit;
      cursor: pointer;
      text-decoration: none;
    }

    .btn:disabled {
      opacity: 0.6;
      cursor: default;
    }

    .btn-primary {
      background: var(--button-bg);
      border-color: var(--button-border);
      color: var(--button-color);
    }
  </style>
</head>
<body>
  <main class="card">
    <h1>{{ __('global.maintenanceMode.heading') }}</h1>
    <p>{{ __('global.maintenanceMode.content.pleaseWait') }}</p>
    @if($discordUrl)
      <p>{{ __('global.maintenanceMode.content.joinSupportServer') }}</p>
    @else
      <p>
        {{ __('global.maintenanceMode.content.contactDeveloper') }}
        <a href="{{ $developerContactUrl }}">{{ $developerContactUrl }}</a>
      </p>
    @endif

    <div class="progress-track"><div class="progress-bar" id="progress-bar"></div></div>
    <p id="reload-info">
      {!! str_replace('<1/>', '<span id="next-reload-time"></span>', __('global.maintenanceMode.autoReload')) !!}
    </p>

    <div class="actions">
      @if($discordUrl)
        <a class="btn btn-primary" href="{{ $discordUrl }}">{{ __('global.maintenanceMode.supportServerButton') }}</a>
      @endif
      <button class="btn" id="reload-btn" type="button">{{ __('global.maintenanceMode.reloadButton') }}</button>
    </div>
  </main>

  <script>
    (function () {
      // Vanilla re-implementation of the useExponentialBackoff composable
      // (resources/js/composables/useExponentialBackoff.ts) - same 2^n * 500ms
      // schedule and manual-reload cooldown, just without needing the Vue bundle.
      var progressBar = document.getElementById('progress-bar');
      var nextReloadTimeEl = document.getElementById('next-reload-time');
      var reloadBtn = document.getElementById('reload-btn');
      var manualRefreshMinimumDelay = 1000;

      var refreshCount = 0;
      var timerStart = 0;
      var nextExecutionAt = 0;
      var executionTimeout = null;
      var progressInterval = null;
      var updating = false;

      // Intl.RelativeTimeFormat gives a fully localized "in N seconds" phrase natively (no
      // date-fns available here - see the Vite-manifest comment above) - same composition
      // the app's own relative-timestamp display (TimestampPreview.vue's fromNow()) uses,
      // just without the library behind it.
      var relativeTimeFormatter = null;
      try {
        relativeTimeFormatter = new Intl.RelativeTimeFormat(document.documentElement.lang, { numeric: 'auto' });
      } catch (e) {
        relativeTimeFormatter = null;
      }

      function clearProgressInterval() {
        if (progressInterval !== null) {
          clearInterval(progressInterval);
          progressInterval = null;
        }
      }

      function updateCountdownText() {
        if (!nextExecutionAt) {
          nextReloadTimeEl.textContent = '';
          return;
        }
        var remainingSeconds = Math.max(0, Math.ceil((nextExecutionAt - Date.now()) / 1000));
        nextReloadTimeEl.textContent = relativeTimeFormatter
          ? relativeTimeFormatter.format(remainingSeconds, 'second')
          : '(' + remainingSeconds + 's)';
      }

      function attemptReload() {
        return fetch(location.href, { method: 'HEAD', cache: 'no-store' })
          .then(function (response) { return response.ok; })
          .catch(function () { return false; });
      }

      function scheduleNext() {
        var delay = Math.pow(2, refreshCount++) * 500;
        timerStart = Date.now();
        nextExecutionAt = timerStart + delay;
        progressBar.style.width = '0%';
        updateCountdownText();

        clearProgressInterval();
        progressInterval = setInterval(function () {
          var progress = Math.min((Date.now() - timerStart) / (nextExecutionAt - timerStart), 1);
          progressBar.style.width = (progress * 100) + '%';
          updateCountdownText();
        }, 200);

        executionTimeout = setTimeout(function () {
          clearProgressInterval();
          progressBar.style.width = '100%';
          setUpdating(true);
          attemptReload().then(function (ok) {
            if (ok) {
              location.reload();
              return;
            }
            setUpdating(false);
            scheduleNext();
          });
        }, delay);
      }

      function setUpdating(value) {
        updating = value;
        reloadBtn.disabled = value;
        if (!value) {
          setTimeout(function () {
            reloadBtn.disabled = false;
          }, manualRefreshMinimumDelay);
        }
      }

      reloadBtn.addEventListener('click', function () {
        if (updating) {
          return;
        }
        setUpdating(true);
        attemptReload().then(function (ok) {
          if (ok) {
            location.reload();
            return;
          }
          setUpdating(false);
        });
      });

      scheduleNext();
    })();
  </script>
</body>
</html>
