<?php

it('copies the syntax of a format to the clipboard', function (string $format) {
  $page = visitHome();
  stubClipboard($page);
  $syntax = rowSyntax($page, $format);

  $button = $page->page()->getByTestId("timestamp-row-$format")->locator('.copyable-text-button');
  $button->click();

  expect($page->script('() => window.__copied'))->toBe([$syntax])
    ->and($button->getAttribute('class'))->toContain('button-success');
  $page->assertSee('Copied to clipboard!');
})->with(['d', 'f', 'R', 'unix']);
