<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use Illuminate\Database\QueryException;

function callWithoutLoggingQueryBindings(callable $callback): mixed {
    $method = new ReflectionMethod(AuthController::class, 'withoutLoggingQueryBindings');

    return $method->invoke(null, $callback);
}

function makeQueryException(string $driverMessage): QueryException {
    $pdoException = new PDOException("SQLSTATE[42501]: $driverMessage");
    $pdoException->errorInfo = ['42501', 7, $driverMessage];

    return new QueryException(
        'pgsql',
        'update "discord_users" set "access_token" = ?, "refresh_token" = ? where "id" = ?',
        ['secret-access-token', 'secret-refresh-token', '123'],
        $pdoException,
    );
}

test('passes the callback result through', function () {
    expect(callWithoutLoggingQueryBindings(fn() => 'ok'))->toBe('ok');
});

test('rethrows query errors without bound values or a chained exception', function () {
    $callback = fn() => throw makeQueryException("ERROR:  permission denied for table discord_users\nDETAIL:  Key (access_token)=(secret-access-token) already exists.");

    try {
        callWithoutLoggingQueryBindings($callback);
        $this->fail('Expected an exception');
    } catch (RuntimeException $e) {
        expect($e)->not->toBeInstanceOf(QueryException::class)
            ->and($e->getPrevious())->toBeNull()
            ->and($e->getMessage())->not->toContain('secret-')
            ->and($e->getMessage())->toContain('permission denied for table discord_users')
            ->and($e->getMessage())->toContain('"access_token" = ?');
    }
});

test('leaves other exceptions alone', function () {
    callWithoutLoggingQueryBindings(fn() => throw new LogicException('unrelated'));
})->throws(LogicException::class, 'unrelated');
