<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SentryWarning
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip middleware for the acknowledgment route
        if ($request->routeIs('sentry-warning.acknowledge')) {
            return $next($request);
        }

        $sentryDsn = config('analytics.sentry_dsn');

        if (!$sentryDsn) {
            return $next($request);
        }

        if (Session::get('sentry_warning_acknowledged', false)) {
            return $next($request);
        }

        $host = $request->getHost();
        $liveUrl = $request->getScheme() . '://' . $this->removeBetaSubdomain($host) . $request->getRequestUri();

        return response()->view('sentry-warning', [
            'sentryDsn' => $sentryDsn,
            'liveUrl' => $liveUrl,
        ]);
    }

    private function removeBetaSubdomain(string $host): string
    {
        return preg_replace('/^beta\./', '', $host);
    }
}
