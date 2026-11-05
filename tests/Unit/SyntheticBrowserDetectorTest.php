<?php

declare(strict_types=1);

use App\Services\SyntheticBrowserDetector;

$chrome = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36';
$safari = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/19.0 Safari/605.1.15';

test('flags Chrome and Firefox user agents missing browser headers', function (array $headers) {
    expect((new SyntheticBrowserDetector())->isSynthetic($headers))->toBeTrue();
})->with([
    'no headers at all' => [['HTTP_USER_AGENT' => $chrome]],
    'no Sec-Fetch-Mode' => [['HTTP_USER_AGENT' => $chrome, 'HTTP_ACCEPT_LANGUAGE' => 'en-US']],
    'no Accept-Language' => [['HTTP_USER_AGENT' => $chrome, 'HTTP_SEC_FETCH_MODE' => 'navigate']],
]);

test('does not flag real browsers or unrelated user agents', function (array $headers) {
    expect((new SyntheticBrowserDetector())->isSynthetic($headers))->toBeFalse();
})->with([
    'Chrome with headers' => [['HTTP_USER_AGENT' => $chrome, 'HTTP_SEC_FETCH_MODE' => 'navigate', 'HTTP_ACCEPT_LANGUAGE' => 'en-US']],
    'Safari without Sec-Fetch' => [['HTTP_USER_AGENT' => $safari]],
    'curl' => [['HTTP_USER_AGENT' => 'curl/8.9.1']],
    'no user agent' => [[]],
]);
