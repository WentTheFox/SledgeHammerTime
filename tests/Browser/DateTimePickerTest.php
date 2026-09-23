<?php

use Illuminate\Support\Carbon;

beforeEach(function () {
  $this->now = Carbon::now('UTC');
  $this->expected = Carbon::create($this->now->year, $this->now->month, 15, 9, 30, 15, 'UTC');
});

it('picks a date and time with the combined custom picker', function () {
  $page = visitHome();
  setHourCycle($page, 'h24');

  $popup = openPicker($page, 'datetimepicker-input', 'datetime-picker-popup');
  clickCalendarDate($popup, $this->now->year, $this->now->month, 15);
  typeCustomTime($popup, '09', '30', '15');
  $popup->getByTestId('picker-form-submit-button')->click();

  $unix = $this->expected->timestamp;
  expect(rowSyntax($page, 'unix'))->toBe((string)$unix)
    ->and(rowSyntax($page, 'f'))->toBe("<t:$unix:f>")
    ->and($page->page()->getByTestId('datetimepicker-input')->inputValue())->toBe($this->expected->format('F j, Y G:i:s'));
});

it('discards changes when the combined custom picker is closed', function () {
  $page = visitHome();
  setHourCycle($page, 'h24');

  $popup = openPicker($page, 'datetimepicker-input', 'datetime-picker-popup');
  clickCalendarDate($popup, $this->now->year, $this->now->month, 15);
  typeCustomTime($popup, '09', '30', '15');
  // Editing the seconds switches the dial to seconds mode, which is the state a user closing the popup would be in
  $popup->locator('.time-dial[data-mode=seconds]')->waitFor(['state' => 'attached']);
  $popup->getByTestId('picker-form-close-button')->click();
  $popup->waitFor(['state' => 'hidden']);

  // The untouched picker follows the current time, so compare against the picked value rather than the initial one
  expect(currentUnix($page))->not->toBe($this->expected->timestamp)
    ->and($page->page()->getByTestId('datetimepicker-input')->inputValue())->not->toBe($this->expected->format('F j, Y G:i:s'));
});

it('picks the date and time separately with the custom pickers', function () {
  $page = visitHome();
  $page->check('#separate-inputs');

  $datePopup = openPicker($page, 'datepicker-input', 'date-picker-popup');
  clickCalendarDate($datePopup, $this->now->year, $this->now->month, 15);
  // The date picker selects on click, so it closes by itself
  $datePopup->waitFor(['state' => 'hidden']);

  $timePopup = openPicker($page, 'timepicker-input', 'time-picker-popup');
  setHourCycle($page, 'h24');
  typeCustomTime($timePopup, '09', '30', '15');
  $timePopup->getByTestId('picker-form-submit-button')->click();

  expect(currentUnix($page))->toBe($this->expected->timestamp);
});

it('picks the date and time with the combined native input', function () {
  $page = visitHome();
  $page->uncheck('#custom-date-input');
  $page->uncheck('#custom-time-input');

  $input = $page->page()->getByTestId('datetimepicker-input');
  expect($input->getAttribute('type'))->toBe('datetime-local');
  $input->fill($this->expected->format('Y-m-d\TH:i:s'));

  expect(currentUnix($page))->toBe($this->expected->timestamp);
});

it('picks the date with the custom picker and the time with a separate native input', function () {
  $page = visitHome();
  $page->uncheck('#custom-time-input');
  $page->check('#separate-inputs');

  $datePopup = openPicker($page, 'datepicker-input', 'date-picker-popup');
  clickCalendarDate($datePopup, $this->now->year, $this->now->month, 15);
  $datePopup->waitFor(['state' => 'hidden']);

  $timeInput = $page->page()->getByTestId('timepicker-input');
  expect($timeInput->getAttribute('type'))->toBe('time');
  $timeInput->fill($this->expected->format('H:i:s'));

  expect(currentUnix($page))->toBe($this->expected->timestamp);
});

it('always uses the combined input when the custom date input is disabled', function () {
  $page = visitHome();
  $page->uncheck('#custom-date-input');
  $page->check('#separate-inputs');

  expect($page->page()->getByTestId('datetimepicker-input')->count())->toBe(1)
    ->and($page->page()->getByTestId('datepicker-input')->count())->toBe(0)
    ->and($page->page()->getByTestId('timepicker-input')->count())->toBe(0);
});

it('picks the date with the custom calendar and the time with a native input', function () {
  $page = visitHome();
  $page->uncheck('#custom-time-input');

  $popup = openPicker($page, 'datetimepicker-input', 'datetime-picker-popup');
  clickCalendarDate($popup, $this->now->year, $this->now->month, 15);
  $popup->getByTestId('date-time-picker-time-input-input')->fill($this->expected->format('H:i:s'));
  $popup->getByTestId('picker-form-submit-button')->click();

  expect(currentUnix($page))->toBe($this->expected->timestamp);
});
