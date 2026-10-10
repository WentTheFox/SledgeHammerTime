<?php

use Illuminate\Support\Carbon;

it('starts at the current time', function () {
  $page = visitHome();

  expect(currentUnix($page))->toBeGreaterThan(Carbon::now()->subMinutes(2)->timestamp)
    ->toBeLessThanOrEqual(Carbon::now()->timestamp);
  $page->assertNoJavaScriptErrors();
});

it('renders every timestamp format for the same moment', function () {
  $page = visitHome();
  // Pin the time so the clock can't tick over to the next minute between reading the rows
  $moment = Carbon::create(2026, 1, 15, 12, 30, 0, 'UTC');
  pickFixedDateTime($page, $moment);

  foreach (['d', 'D', 't', 'T', 'f', 'F', 's', 'S', 'R'] as $format) {
    expect(rowSyntax($page, $format))->toBe("<t:$moment->timestamp:$format>");
  }

  $page->assertNoJavaScriptErrors();
});

it('resets the picker to the current time', function () {
  $page = visitHome();
  pickFixedDateTime($page, Carbon::create(2020, 1, 1, 12, 0, 0, 'UTC'));

  $page->page()->getByTestId('set-current-time-button')->click();

  $page->page()->waitForFunction(
    '(minimum) => Number(document.querySelector("[data-testid=timestamp-row-unix] .copyable-text-data")?.textContent) >= minimum',
    Carbon::now()->subMinutes(2)->timestamp,
  );
  expect(currentUnix($page))->toBeLessThanOrEqual(Carbon::now()->timestamp);
});
