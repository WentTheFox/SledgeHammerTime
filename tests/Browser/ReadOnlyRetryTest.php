<?php

use App\Models\User;
use App\Support\ReadOnlyMode;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

afterEach(fn() => ReadOnlyMode::disable());

it('retries a form submit that was rejected while the site was read-only', function () {
  $user = User::factory()->create(['name' => 'Before']);
  $this->actingAs($user);
  ReadOnlyMode::disable();

  $page = visit(route('profile.edit', ['locale' => config('app.fallback_locale')]))->on()->desktop();

  ReadOnlyMode::enable();
  $page->fill('input[autocomplete="name"]', 'After')->click('form button[type="submit"]');
  // The first attempt is answered with 503 + Retry-After while the site is read-only. The deploy finishes in the meantime
  $page->wait(1);
  ReadOnlyMode::disable();
  // Retry-After is ReadOnlyMode::RETRY_AFTER_SECONDS, plus up to a second of jitter
  $page->wait(ReadOnlyMode::RETRY_AFTER_SECONDS + 2);

  expect($user->fresh()->name)->toBe('After');
  // Inertia's fallback for a response it can't handle is a dialog showing the page
  $page->assertScript('document.querySelector("dialog") === null');
});
