<?php

/**
 * Visits the API reference, which is a page of accordions, and waits for the app to be interactive
 */
function visitApiReference(): Pest\Browser\Api\PendingAwaitablePage {
  $page = visit(route('api', ['locale' => 'en']))->on()->desktop()->withTimezone('UTC');
  waitForApp($page);

  return $page;
}

it('keeps closed accordion items searchable with find-in-page', function () {
  $page = visitApiReference();
  $item = $page->page()->locator('.api-operation')->first();
  $body = $item->locator('.collapsible');

  expect($body->getAttribute('hidden'))->toBe('until-found')
    ->and($item->locator('.accordion-item-toggle')->getAttribute('aria-expanded'))->toBe('false');

  $item->locator('.accordion-item-toggle')->click();
  expect($body->getAttribute('hidden'))->toBeNull();
});

it('opens a closed accordion item when find-in-page reveals a match inside it', function () {
  $page = visitApiReference();
  $item = $page->page()->locator('.api-operation')->first();
  $toggle = $item->locator('.accordion-item-toggle');

  // Find-in-page can't be driven from automation, but navigating to a fragment inside the content runs the same
  // reveal steps and fires `beforematch` on the hidden=until-found ancestor
  $page->script('() => {
    const marker = document.createElement("span");
    marker.id = "find-in-page-marker";
    document.querySelector(".api-operation .accordion-item-body").append(marker);
    location.hash = "#find-in-page-marker";
  }');

  $page->page()->waitForFunction('() => document.querySelector(".api-operation .accordion-item-toggle").getAttribute("aria-expanded") === "true"');
  expect($toggle->getAttribute('aria-expanded'))->toBe('true')
    ->and($item->locator('.collapsible')->getAttribute('hidden'))->toBeNull();
});
