{{-- Overrides the framework's errors::minimal (used by its default 401/402/403/404/419/429/500/503 pages) to add the
     OpenTelemetry trace id, so it can be quoted in bug reports. Kept deliberately plain: no Vite assets, so it renders
     even when the build is missing. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <style>
    :root { color-scheme: light dark; }
    body { margin: 0; font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; line-height: 1.5; }
    main { min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; }
    .row { display: flex; align-items: center; font-size: 1.125rem; }
    .code { padding: 0 1rem; border-right: 1px solid #cbd5e0; }
    .message { padding-left: 1rem; }
    .trace { margin-top: 1rem; font-size: .8rem; opacity: .7; }
    code { font-family: Menlo, Monaco, Consolas, "Liberation Mono", monospace; }
  </style>
</head>
<body>
  <main role="main">
    <div class="row">
      <h1 class="code" style="margin:0;font-size:inherit;font-weight:inherit">@yield('code')</h1>
      <div class="message">@yield('message')</div>
    </div>
    @if($traceId = \App\Http\Middleware\AddTraceIdHeader::currentTraceId())
      <p class="trace">Trace ID: <code>{{ $traceId }}</code></p>
    @endif
  </main>
</body>
</html>
