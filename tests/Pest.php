<?php

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
