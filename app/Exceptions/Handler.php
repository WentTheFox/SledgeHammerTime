<?php

namespace App\Exceptions;

use App\Http\Middleware\HandleInertiaRequests;
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
      return Inertia::render('Errors/MaintenanceMode', [
        ...HandleInertiaRequests::getGlobalSharedArray($request),
        'discordUrl' => config('services.discord.invite_url'),
      ])->toResponse($request)->setStatusCode($status);
    }

    if ($request->expectsJson()){
      return $response;
    }

    return match ($status) {
      404 => Inertia::render('Errors/NotFound')->toResponse($request)->setStatusCode($status),
      default => $response
    };
  }
}
