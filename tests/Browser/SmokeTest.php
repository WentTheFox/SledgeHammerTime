<?php

$publicRoutes = ['home', 'design', 'legal', 'botInfo', 'addBot', 'status'];

it('should open the route correctly', function (string $name) {
  $pages = visit(route($name, ['locale' => config('app.fallback_locale')]))->on()->desktop();
  $pages->assertNoSmoke();
})->with($publicRoutes);
