<?php

use Illuminate\Support\Carbon;

it('renders every timestamp format for the same moment', function () {
  $page = visitHome();
  $unix = currentUnix($page);

  foreach (['d', 'D', 't', 'T', 'f', 'F', 's', 'S', 'R'] as $format) {
    expect(rowSyntax($page, $format))->toBe("<t:$unix:$format>");
  }

  expect($unix)->toBeGreaterThan(Carbon::now()->subMinutes(2)->timestamp)
    ->toBeLessThanOrEqual(Carbon::now()->timestamp);
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
