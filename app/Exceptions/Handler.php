<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler {
  /**
   * The list of the inputs that are never flashed to the session on validation exceptions.
   *
   * @var array<int, string>
   */
  protected $dontFlash = [
    'current_password',
    'password',
    'password_confirmation',
  ];

  /**
   * Register the exception handling callbacks for the application.
   */
  public function register():void {
    $this->reportable(function (Throwable $e) {
      //
    });
  }

  public function render($request, Throwable $e) {
    $response = parent::render($request, $e);
    $status = $response->getStatusCode();
    if ($status === 503 && !$request->expectsJson()){
      // Deliberately not an Inertia::render() here: that would need the Vite manifest to
      // resolve the page's JS/CSS, which is briefly missing while a deploy's `pnpm run
      // build` step empties and rewrites public/build - exactly the window this response
      // needs to cover. This view is plain Blade with everything inlined so it renders
      // regardless of build state.
      return response()->view('errors.maintenance', [
        'discordUrl' => config('services.discord.invite_url'),
        // Same config('services.developer.contact_url') value the rest of the app gets via
        // the developerContactUrl Inertia shared prop (HandleInertiaRequests) - this view
        // reads the config directly since it can't rely on a built Inertia page existing.
        'developerContactUrl' => config('services.developer.contact_url'),
      ], $status);
    }

    if ($request->expectsJson()){
      return $response;
    }

    return match ($status) {
      404 => Inertia::render('Errors/NotFound', [
        'discordUrl' => config('services.discord.invite_url'),
      ])->toResponse($request)->setStatusCode($status),
      default => $response
    };
  }
}
