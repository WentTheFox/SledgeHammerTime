<?php

it('stays on the app page when switching language', function () {
  $device = visit(route('botInfo', ['locale' => 'en']))->on()->desktop();
  $page = $device->page();

  $page->waitForSelector('.change-language-button', ['timeout' => 8000]);
  $page->locator('.change-language-button')->click();
  $page->waitForSelector('.language-list', ['timeout' => 8000]);
  $page->locator('a.language-link')->getByText('Magyar', true)->click();
  $page->waitForURL('**/hu/app');

  expect(parse_url($page->url(), PHP_URL_PATH))->toBe('/hu/app');
});
