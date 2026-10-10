<?php

use Illuminate\Support\Carbon;

it('copies the syntax of a format to the clipboard', function (string $format) {
  $page = visitHome();
  // Pin the picked time so the displayed value can't tick over to the next minute between reading and clicking
  pickFixedDateTime($page, Carbon::parse('2026-01-15 12:30:00', 'UTC'));
  stubClipboard($page);
  $syntax = rowSyntax($page, $format);

  $button = $page->page()->getByTestId("timestamp-row-$format")->locator('.copyable-text-button');
  $button->click();

  expect($page->script('() => window.__copied'))->toBe([$syntax])
    ->and($button->getAttribute('class'))->toContain('button-success');
  $page->assertSee('Copied to clipboard!');
})->with(['d', 'f', 'R', 'unix']);
