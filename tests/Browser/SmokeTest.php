<?php

$publicStaticRoutes = ['home', 'legal', 'botInfo'];

it('should open the route correctly on desktop', function (string $name) {
  $pages = visit(route($name, ['locale' => config('app.fallback_locale')]))->on()->desktop();
  $pages->assertNoSmoke();
})->with($publicStaticRoutes);

it('should open the route correctly on mobile', function (string $name) {
  $pages = visit(route($name, ['locale' => config('app.fallback_locale')]))->on()->mobile();
  $pages->assertNoSmoke();
})->with($publicStaticRoutes);
