<?php

use Pest\Browser\Api\PendingAwaitablePage;

const OPT_OUT_COOKIE = 'ht_trace_optout';
const OPTED_OUT_TEXT = 'You are currently opted out on this device.';
const NOT_OPTED_OUT_TEXT = 'You are currently not opted out on this device.';

function optOutStatus(PendingAwaitablePage $page): string {
  return trim($page->page()->locator('.performance-opt-out-form [role="status"]')->textContent() ?? '');
}

function saveOptOutChoice(PendingAwaitablePage $page, bool $optedOut): void {
  $checkbox = $page->page()->locator('#performance-opt-out');
  $optedOut ? $checkbox->check() : $checkbox->uncheck();
  $page->page()->locator('#opt-out-save')->click();
}

function hasOptOutCookie(PendingAwaitablePage $page): bool {
  return $page->script('() => document.cookie.split(";").some((part) => /^'.OPT_OUT_COOKIE.'=\\d+$/.test(part.trim()))') === true;
}

it('starts out not opted out', function () {
  $page = visitLegal();

  expect(optOutStatus($page))->toBe(NOT_OPTED_OUT_TEXT)
    ->and($page->page()->locator('#performance-opt-out')->isChecked())->toBeFalse()
    ->and(hasOptOutCookie($page))->toBeFalse();
});

it('opts out with a cookie that JavaScript can read, and remembers it after reloading', function () {
  $page = visitLegal();

  saveOptOutChoice($page, true);

  expect(optOutStatus($page))->toBe(OPTED_OUT_TEXT)
    ->and(hasOptOutCookie($page))->toBeTrue();

  reloadPage($page);

  expect(optOutStatus($page))->toBe(OPTED_OUT_TEXT)
    ->and($page->page()->locator('#performance-opt-out')->isChecked())->toBeTrue();
});

it('opts back in by removing the cookie', function () {
  $page = visitLegal();
  saveOptOutChoice($page, true);
  expect(hasOptOutCookie($page))->toBeTrue();

  saveOptOutChoice($page, false);

  expect(optOutStatus($page))->toBe(NOT_OPTED_OUT_TEXT)
    ->and(hasOptOutCookie($page))->toBeFalse();
  reloadPage($page);
  expect($page->page()->locator('#performance-opt-out')->isChecked())->toBeFalse();
});

it('confirms the save and clears the confirmation on its own', function () {
  $page = visitLegal();

  saveOptOutChoice($page, true);
  $page->assertSee('Your choice was saved.');

  // Inertia clears it after 2 seconds for its own forms, and so does this one
  $page->wait(3);
  $page->assertDontSee('Your choice was saved.');
});

it('does not save a change that was not submitted', function () {
  $page = visitLegal();

  $page->page()->locator('#performance-opt-out')->check();

  expect(hasOptOutCookie($page))->toBeFalse()
    ->and(optOutStatus($page))->toBe(NOT_OPTED_OUT_TEXT);
});

it('says when the cookie expires once opted out, whatever the browser reports', function () {
  $page = visitLegal();
  $page->assertDontSee('which currently means it expires');

  saveOptOutChoice($page, true);

  // Browsers that do not report the expiry (Firefox) get the longest lifetime browsers allow
  $page->assertSee('which currently means it expires');
});

it('renews the cookie on every page load', function () {
  $page = visitLegal();
  saveOptOutChoice($page, true);
  // Replace it with a cookie that is about to expire: a page load has to start its lifetime over
  $page->script('() => { document.cookie = "'.OPT_OUT_COOKIE.'=1; Max-Age=3; Path=/; SameSite=Lax"; }');

  reloadPage($page);
  $page->wait(4);

  expect(hasOptOutCookie($page))->toBeTrue();
});

it('shows the policy update notice on every page until it is dismissed', function () {
  $page = visitHome();
  $page->assertSee('Privacy Policy updated.');

  $page->page()->locator('.alert:has-text("Privacy Policy updated") .close-button')->click();
  $page->assertDontSee('Privacy Policy updated.');

  reloadPage($page);
  $page->assertDontSee('Privacy Policy updated.');
  $page->page()->goto(route('legal', ['locale' => 'en']));
  waitForApp($page);
  $page->assertDontSee('Privacy Policy updated.');
});

it('shows the update notice again after a later policy update', function () {
  $page = visitHome();
  // A dismissal from before the latest update does not count
  $page->script('() => localStorage.setItem("privacy-notice-dismissed-at", "2020-01-01T00:00:00.000Z")');

  reloadPage($page);

  $page->assertSee('Privacy Policy updated.');
});

it('keeps the update notice hidden for a dismissal after the latest update', function () {
  $page = visitHome();
  $page->script('() => localStorage.setItem("privacy-notice-dismissed-at", "2099-01-01T00:00:00.000Z")');

  reloadPage($page);

  $page->assertDontSee('Privacy Policy updated.');
});

it('links the update notice to the privacy policy', function () {
  $page = visitHome();

  $href = $page->page()->locator('.alert:has-text("Privacy Policy updated") a')->getAttribute('href');

  expect($href)->toBe(route('legal', ['locale' => 'en']));
});

it('shows the trace id of a request that failed on the server', function () {
  $page = visitHome();
  $traceId = '0af7651916cd43dd8448eb211c80319c';

  // A failed request as axios reports it, with the trace id header the server sends
  $page->script('() => window.axios.get("/frontend/test-failure", { adapter: (config) => {
    const response = { status: 503, statusText: "", headers: { "x-trace-id": "'.$traceId.'" }, data: "", config };
    return Promise.reject(new window.axios.AxiosError("failed", "ERR_BAD_RESPONSE", config, null, response));
  } }).catch(() => {})');

  $page->assertSee('Something went wrong.');
  $page->assertSee($traceId);
});

it('shows nothing for a failed request that has no trace id', function () {
  $page = visitHome();

  $page->script('() => window.axios.get("/frontend/test-failure", { adapter: (config) => {
    const response = { status: 503, statusText: "", headers: {}, data: "", config };
    return Promise.reject(new window.axios.AxiosError("failed", "ERR_BAD_RESPONSE", config, null, response));
  } }).catch(() => {})');

  $page->wait(1);
  $page->assertDontSee('Something went wrong.');
});
