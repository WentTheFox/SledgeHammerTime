<?php

declare(strict_types=1);

use App\Services\OutdatedBrowserDetector;
use Carbon\CarbonImmutable;

$now = CarbonImmutable::parse('2026-09-26 12:00:00', 'UTC');

test('estimates current versions from the release cadence', function () use ($now) {
    $detector = new OutdatedBrowserDetector();

    expect($detector->estimateCurrentVersion('Chrome', CarbonImmutable::parse('2025-09-02', 'UTC')))->toBe(140)
        ->and($detector->estimateCurrentVersion('Chrome', $now))->toBe(153)
        ->and($detector->estimateCurrentVersion('Firefox', $now))->toBe(156);
});

test('flags browsers posing with long outdated versions', function (string $userAgent) use ($now) {
    expect((new OutdatedBrowserDetector())->isOutdated($userAgent, $now))->toBeTrue();
})->with([
    'Chrome 120' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    'Chrome 35' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36',
    'Firefox 121' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0',
]);

test('does not flag current, ESR or unrelated user agents', function (?string $userAgent) use ($now) {
    expect((new OutdatedBrowserDetector())->isOutdated($userAgent, $now))->toBeFalse();
})->with([
    'Chrome 152' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36',
    'Firefox ESR 128' => 'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0',
    'Safari' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/19.0 Safari/605.1.15',
    'curl' => 'curl/8.9.1',
    'missing' => null,
]);
