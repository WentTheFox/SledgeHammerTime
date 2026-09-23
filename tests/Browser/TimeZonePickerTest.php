<?php

use Illuminate\Support\Carbon;

it('defaults to the browser timezone', function () {
  $page = visitHome();

  expect($page->page()->getByTestId('timezonepicker-input')->inputValue())->toBe('UTC');
});

it('keeps the wall clock time when switching to a UTC offset', function () {
  $page = visitHome();
  $pinned = Carbon::create(2026, 3, 15, 9, 30, 15, 'UTC');
  pickFixedDateTime($page, $pinned);

  $popup = openPicker($page, 'timezonepicker-input', 'timezone-picker-popup');
  $popup->locator('input[type=number]')->nth(0)->fill('2');
  $popup->locator('button[type=submit]')->click();

  waitForUnix($page, $pinned->timestamp - 2 * 3600);
  expect($page->page()->getByTestId('timezonepicker-input')->inputValue())->toBe('GMT+02:00');
});

it('keeps the wall clock time when switching to a named timezone', function () {
  $page = visitHome();
  $pinned = Carbon::create(2026, 3, 15, 9, 30, 15, 'UTC');
  pickFixedDateTime($page, $pinned);

  $popup = openPicker($page, 'timezonepicker-input', 'timezone-picker-popup');
  $search = $popup->locator('.form-control-combobox input');
  // Firefox keeps the current value when focusing the input, so clear it before searching
  $search->fill('');
  $search->type('New York');
  $popup->locator('button[data-value="America/New_York"]')->click();
  $popup->locator('button[type=submit]')->click();

  waitForUnix($page, Carbon::create(2026, 3, 15, 9, 30, 15, 'America/New_York')->timestamp);
  expect($page->page()->getByTestId('timezonepicker-input')->inputValue())->toBe('America/New_York');
});
