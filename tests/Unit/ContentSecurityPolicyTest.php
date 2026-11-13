<?php

declare(strict_types=1);

use App\Http\Middleware\AddContentSecurityPolicy;
use App\Services\ContentSecurityPolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

function cspHash(string $script): string {
    return "'sha256-" . base64_encode(hash('sha256', $script, true)) . "'";
}

test('hashes the executable inline scripts exactly as they appear in the page', function () {
    $ziggy = 'const Ziggy={"url":"https:\/\/hammertime.cyou","port":null};';
    $other = "\n  window.dataLayer = [];\n";
    $html = '<html><head>'
        . '<script type="text/javascript">' . $ziggy . '</script>'
        . '<script>' . $other . '</script>'
        . '<script type=\'module\'>import "/x.js";</script>'
        . '</head></html>';

    expect(ContentSecurityPolicy::inlineScriptHashes($html))->toBe([
        cspHash($ziggy),
        cspHash($other),
        cspHash('import "/x.js";'),
    ]);
});

test('leaves out external scripts, data blocks, empty scripts and duplicates', function () {
    $html = '<script src="/build/app.js" type="module"></script>'
        . '<script type="module" crossorigin src=\'/build/x.js\'></script>'
        . '<script data-page="app" type="application/json">{"component":"Picker\/IndexComponent"}</script>'
        . '<script type="importmap">{"imports":{}}</script>'
        . '<script>   </script>'
        . '<script>var a=1;</script><script>var a=1;</script>';

    expect(ContentSecurityPolicy::inlineScriptHashes($html))->toBe([cspHash('var a=1;')]);
});

test('finds nothing in a page without scripts', function () {
    expect(ContentSecurityPolicy::inlineScriptHashes('<html><body>hi</body></html>'))->toBe([]);
});

test('the policy allows only this site and the listed hashes for scripts', function () {
    $policy = ContentSecurityPolicy::build([cspHash('a'), cspHash('b')], 'https://csp.example/r');

    expect($policy)
        ->toContain("script-src 'self' " . cspHash('a') . ' ' . cspHash('b') . ';')
        ->toContain("script-src-attr 'none'")
        ->toContain("object-src 'none'")
        ->toContain('https://seccdn.libravatar.org')
        ->toContain('https://cdn.discordapp.com')
        ->toContain('https://crowdin-static.cf-downloads.crowdin.com')
        ->toContain('report-uri https://csp.example/r; report-to csp-endpoint')
        ->not->toContain('unsafe-eval')
        ->not->toContain("script-src 'self' 'unsafe-inline'");
    expect(ContentSecurityPolicy::reportingEndpoints('https://csp.example/r'))->toBe('csp-endpoint="https://csp.example/r"');
});

function runCspMiddleware(Response|JsonResponse $response, ?string $reportUri = 'https://csp.example/r'): \Symfony\Component\HttpFoundation\Response {
    Config::set('app.csp.report_uri', $reportUri);

    return (new AddContentSecurityPolicy())->handle(Request::create('/en'), fn () => $response);
}

test('adds the report-only policy computed from the final body to HTML pages', function () {
    $script = 'const Ziggy={"location":"https:\/\/hammertime.cyou\/en?t=1"};';
    $result = runCspMiddleware(new Response('<html><script>' . $script . '</script></html>', 200, ['Content-Type' => 'text/html; charset=UTF-8']));

    expect($result->headers->get('Content-Security-Policy-Report-Only'))->toContain(cspHash($script))
        ->and($result->headers->get('Reporting-Endpoints'))->toBe('csp-endpoint="https://csp.example/r"')
        ->and($result->headers->has('Content-Security-Policy'))->toBeFalse();   // never enforced
});

test('sends no policy without a report endpoint, or for responses that are not pages', function (Response|JsonResponse $response, ?string $reportUri) {
    $result = runCspMiddleware($response, $reportUri);

    expect($result->headers->has('Content-Security-Policy-Report-Only'))->toBeFalse()
        ->and($result->headers->has('Reporting-Endpoints'))->toBeFalse();
})->with([
    'no endpoint configured' => [fn () => new Response('<html></html>', 200, ['Content-Type' => 'text/html']), ''],
    'JSON (API, Inertia navigation)' => [fn () => new JsonResponse(['ok' => true]), 'https://csp.example/r'],
    'Inertia response' => [fn () => new Response('<html></html>', 200, ['Content-Type' => 'text/html', 'X-Inertia' => 'true']), 'https://csp.example/r'],
    'redirect' => [fn () => new Response('', 302, ['Content-Type' => 'text/html']), 'https://csp.example/r'],
    'not modified' => [fn () => new Response('', 304, ['Content-Type' => 'text/html']), 'https://csp.example/r'],
]);
