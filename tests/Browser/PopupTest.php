<?php

use Tests\Breakpoint;

it('should open the datetime picker popup correctly', function (Breakpoint $breakpoint) {
  $locale = config('app.fallback_locale');
  $device = visit(route('home', ['locale' => $locale]))->on()->desktop();
  $page = $device->withTimezone('UTC')->withLocale($locale);

  resize($page, $breakpoint);

  $page->check('#custom-date-input');
  $page->check('#custom-time-input');
  $page->uncheck('#separate-inputs');
  $playwrightPage = $page->page();
  $playwrightPage->getByTestId('datetimepicker-input')->click();
  $playwrightPage->getByTestId('datetime-picker-popup')->waitFor(['state' => 'visible']);

  expect($page->page()->getByTestId('picker-form-submit-button'))->toBeInViewport($playwrightPage)
    ->and($page->page()->getByTestId('picker-form-close-button'))->toBeInViewport($playwrightPage);
})->with('default breakpoints');
