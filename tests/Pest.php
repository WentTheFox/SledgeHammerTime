<?php

use Illuminate\Support\Carbon;
use Pest\Browser\Api\On;
use Pest\Browser\Api\PendingAwaitablePage;
use Pest\Browser\Playwright\Locator;
use Pest\Browser\Playwright\Page;
use Pest\Expectation;
use PHPUnit\Framework\Assert;
use Tests\Breakpoint;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
  // ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
  ->in('Feature', 'Unit', 'Browser');

pest()->browser()->inDarkMode();

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeInViewport', function (Page $page) {
  /** @var Expectation $this */
  $locators = is_array($this->value) ? $this->value : [$this->value];
  foreach ($locators as $locator){
    assert($locator instanceof Locator);

    $box = $locator->boundingBox();
    Assert::assertNotEmpty($box, "Element {$locator->selector()} has no bounding box (not visible at all)");

    $viewport = $page->viewportSize();
    Assert::assertNotEmpty($viewport, "Viewport size is unavailable");

    $left = $box['x'];
    $right = $box['x'] + $box['width'];
    $top = $box['y'];
    $bottom = $box['y'] + $box['height'];

    $isInside =
      $left >= 0 &&
      $top >= 0 &&
      $right <= $viewport['width'] &&
      $bottom <= $viewport['height'];

    Assert::assertTrue($isInside, "Element {$locator->selector()} is outside the viewport");
  }

  return $this;
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

/* function something()
{
    // ..
} */

function resize(PendingAwaitablePage|On $page, Breakpoint $breakpoint, int $height = 768):void {
  $page->resize($breakpoint->value, $height);
}

/**
 * Waits until the client-side app is mounted
 *
 * The page is server-side rendered, so elements are visible before they are interactive, and local settings are only
 * read from localStorage once the app mounts.
 */
function waitForApp(PendingAwaitablePage $page): void {
  $page->page()->waitForFunction('() => Boolean(document.querySelector("[data-v-app]")?.__vue_app__)');
}

/**
 * Opens the home page (UTC browser timezone, en-US browser locale) and waits for the app to be interactive
 */
function visitHome(array $query = [], string $locale = 'en'): PendingAwaitablePage {
  // Calls on `On` create a brand new page every time, only the returned `PendingAwaitablePage` reuses its page
  $page = visit(route('home', ['locale' => $locale, ...$query]))->on()->desktop()->withTimezone('UTC');
  waitForApp($page);

  return $page;
}

/**
 * Reloads the page (keeping localStorage) and waits for the app to be interactive again
 */
function reloadPage(PendingAwaitablePage $page): void {
  $page->refresh();
  waitForApp($page);
}

/**
 * Returns the syntax text shown in the timestamp table for the given format (or 'unix' for the raw value)
 */
function rowSyntax(PendingAwaitablePage $page, string $format): string {
  return trim($page->page()->getByTestId("timestamp-row-$format")->locator('.copyable-text-data')->textContent() ?? '');
}

function currentUnix(PendingAwaitablePage $page): int {
  return (int)rowSyntax($page, 'unix');
}

/**
 * Replaces the clipboard API with a stub that records written values in `window.__copied`
 */
function stubClipboard(PendingAwaitablePage $page): void {
  $page->script('() => { window.__copied = []; navigator.clipboard.writeText = (text) => { window.__copied.push(text); return Promise.resolve(); }; }');
}

/**
 * Types a time into the custom time picker inputs (which advance focus automatically after each two digits)
 */
function typeCustomTime(Locator $popup, string $hours, string $minutes, string $seconds): void {
  $inputs = $popup->locator('.time-picker-input');
  $inputs->nth(0)->click();
  $inputs->nth(0)->type($hours);
  $inputs->nth(1)->type($minutes);
  $inputs->nth(2)->type($seconds);
}

/**
 * Clicks the given day in the custom date picker calendar
 */
function clickCalendarDate(Locator $popup, int $year, int $month, int $date): void {
  $popup->locator("label:has(#calendar-button-date-$year-$month-$date)")->click();
}

/**
 * Sets the hour cycle input setting in the sidebar ('h12', 'h24' or 'Language default')
 */
function setHourCycle(PendingAwaitablePage $page, string $hourCycle): void {
  $page->page()->locator('#hour-cycle')->selectOption($hourCycle);
}

/**
 * Clicks the given picker input and waits for its popup to open
 */
function openPicker(PendingAwaitablePage $page, string $inputTestId, string $popupTestId): Locator {
  $page->page()->getByTestId($inputTestId)->click();
  $popup = $page->page()->getByTestId($popupTestId);
  $popup->waitFor(['state' => 'visible']);

  return $popup;
}

/**
 * Waits until the timestamp table shows the given unix timestamp
 */
function waitForUnix(PendingAwaitablePage $page, int $expected): void {
  $page->page()->waitForFunction(
    '(expected) => document.querySelector("[data-testid=timestamp-row-unix] .copyable-text-data")?.textContent.trim() === String(expected)',
    $expected,
  );
}

/**
 * Picks a fixed date and time through the native combined input, which also stops the picker from following the clock
 */
function pickFixedDateTime(PendingAwaitablePage $page, Carbon $dateTime): void {
  $page->uncheck('#custom-date-input');
  $page->uncheck('#custom-time-input');
  // Browsers normalize away zero seconds, which Playwright would reject as a malformed value
  $page->page()->getByTestId('datetimepicker-input')->fill($dateTime->format($dateTime->second === 0 ? 'Y-m-d\\TH:i' : 'Y-m-d\\TH:i:s'));
  waitForUnix($page, $dateTime->timestamp);
}
