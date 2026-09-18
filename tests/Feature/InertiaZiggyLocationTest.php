<?php

namespace Tests\Feature;

use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class InertiaZiggyLocationTest extends TestCase
{
  /**
   * ziggy-js's `location` override is typed as {host?, pathname?, search?} - not a URL
   * string (see resources/js/Components/LanguageSelector.vue and
   * app/Http/Middleware/HandleInertiaRequests.php for the full story). A bare string here
   * makes every ziggy-js property access on it silently read undefined, so Ziggy falls
   * through to window.location, which doesn't exist under SSR - meaning route().current()
   * returns undefined for every route on every SSR'd page, and any URL built from "the
   * current route" (e.g. the language switcher's links) silently falls back to the home
   * route instead. This regressed once already; assert the shape directly since it can
   * only be caught end-to-end with a real SSR render, which this test suite doesn't run.
   */
  public function test_ziggy_location_is_shaped_for_ssr()
  {
    $this->get('/en/app')->assertInertia(fn (AssertableInertia $page) => $page
      ->has('ziggy.location', fn (AssertableInertia $location) => $location
        ->where('host', request()->getHttpHost())
        ->where('pathname', '/en/app')
        ->where('search', '')
      )
    );
  }
}
