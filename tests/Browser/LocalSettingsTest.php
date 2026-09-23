<?php

use Illuminate\Support\Carbon;

it('remembers the input settings after reloading', function () {
  $page = visitHome();
  $page->uncheck('#custom-time-input');
  $page->check('#separate-inputs');

  $assertSettingsApplied = function () use ($page) {
    $page->assertChecked('#custom-date-input')
      ->assertNotChecked('#custom-time-input')
      ->assertChecked('#separate-inputs');
    expect($page->page()->getByTestId('datepicker-input')->count())->toBe(1)
      ->and($page->page()->getByTestId('timepicker-input')->getAttribute('type'))->toBe('time')
      ->and($page->page()->getByTestId('datetimepicker-input')->count())->toBe(0);
  };

  $assertSettingsApplied();
  reloadPage($page);
  $assertSettingsApplied();
});

it('switches to native inputs when the custom inputs are disabled', function () {
  $page = visitHome();
  expect($page->page()->getByTestId('datetimepicker-input')->getAttribute('readonly'))->not->toBeNull();

  $page->uncheck('#custom-date-input');
  $page->uncheck('#custom-time-input');

  expect($page->page()->getByTestId('datetimepicker-input')->getAttribute('type'))->toBe('datetime-local');
});

it('formats the time according to the hour cycle setting', function () {
  $page = visitHome();
  $pinned = Carbon::create(2026, 3, 15, 21, 30, 15, 'UTC');
  pickFixedDateTime($page, $pinned);
  $page->check('#custom-date-input');
  $page->check('#custom-time-input');
  $input = $page->page()->getByTestId('datetimepicker-input');

  setHourCycle($page, 'h24');
  expect($input->inputValue())->toBe('March 15, 2026 21:30:15');
  $popup = openPicker($page, 'datetimepicker-input', 'datetime-picker-popup');
  expect($popup->locator('select')->count())->toBe(0);
  $popup->getByTestId('picker-form-close-button')->click();

  setHourCycle($page, 'h12');
  expect($input->inputValue())->toBe('March 15, 2026 9:30:15 PM');
  $popup = openPicker($page, 'datetimepicker-input', 'datetime-picker-popup');
  expect($popup->locator('select')->count())->toBe(1);
  $popup->getByTestId('picker-form-close-button')->click();

  reloadPage($page);
  expect($page->page()->locator('#hour-cycle')->inputValue())->toBe('h12');
});

it('parses natural language input', function () {
  $page = visitHome();
  $page->page()->getByText('Advanced input settings')->click();
  $page->page()->locator('#nlp-input:not([disabled])')->waitFor(['state' => 'attached']);
  $page->check('#nlp-input');

  $page->page()->getByTestId('nlppicker-input')->fill('tomorrow at 5pm');

  $expected = Carbon::tomorrow('UTC')->setTime(17, 0)->timestamp;
  waitForUnix($page, $expected);
  expect(currentUnix($page))->toBe($expected);
});

it('changes the first day of the week in the calendar', function () {
  $page = visitHome();
  $weekdays = fn () => openPicker($page, 'datetimepicker-input', 'datetime-picker-popup')
    ->locator('.calendar-weekdays > *')->allTextContents();
  $closePopup = fn () => $page->page()->getByTestId('picker-form-close-button')->click();

  // The en-US browser locale starts the week on Sunday
  $defaultWeekdays = $weekdays();
  $closePopup();

  $page->page()->getByText('Advanced input settings')->click();
  // Option values are weekday indexes starting with Sunday = 0
  $page->page()->locator('#first-day-of-week')->selectOption('1');

  expect($weekdays())->toBe([...array_slice($defaultWeekdays, 1), $defaultWeekdays[0]]);
});

it('hides formats in the table and restores them', function () {
  $page = visitHome();
  $row = $page->page()->getByTestId('timestamp-row-D');

  $page->page()->getByTestId('timestamp-table-edit-button')->click();
  $row->locator('.controls-column button')->click();
  $page->page()->getByTestId('timestamp-table-edit-button')->click();
  expect($row->count())->toBe(0);

  reloadPage($page);
  expect($row->count())->toBe(0);

  $page->page()->getByTestId('timestamp-table-reset-button')->click();
  $row->waitFor(['state' => 'visible']);
});

it('locks the timestamp into the URL', function () {
  $page = visitHome();
  $pinned = Carbon::create(2026, 3, 15, 9, 30, 15, 'UTC');
  pickFixedDateTime($page, $pinned);

  $page->page()->getByTestId('lock-button')->click();
  $page->page()->waitForURL("**/en?t={$pinned->timestamp}&tz=UTC");
  $page->page()->getByTestId('unlock-button')->waitFor(['state' => 'visible']);
  // The locked timestamp is applied once the initial time sync finishes
  waitForUnix($page, $pinned->timestamp);

  expect(currentUnix($page))->toBe($pinned->timestamp)
    ->and($page->page()->getByTestId('datetimepicker-input')->isDisabled())->toBeTrue();
});

it('keeps the locked timestamp after unlocking', function () {
  $page = visitHome();
  $pinned = Carbon::create(2026, 3, 15, 9, 30, 15, 'UTC');
  pickFixedDateTime($page, $pinned);
  $page->page()->getByTestId('lock-button')->click();
  $page->page()->getByTestId('unlock-button')->waitFor(['state' => 'visible']);
  waitForUnix($page, $pinned->timestamp);

  $page->page()->getByTestId('unlock-button')->click();
  $page->page()->waitForURL('**/en?tz=UTC');
  $page->page()->getByTestId('lock-button')->waitFor(['state' => 'visible']);
  // The value is restored from session storage after the time sync; give any later time sync a chance to override it
  $page->page()->waitForFunction('() => sessionStorage.getItem("lockedDateTime") === null');
  $page->wait(1);

  expect(currentUnix($page))->toBe($pinned->timestamp)
    ->and($page->page()->getByTestId('datetimepicker-input')->isDisabled())->toBeFalse();
});
