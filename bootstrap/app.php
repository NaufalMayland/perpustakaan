<?php

use App\Http\Middleware\Auth;
use App\Http\Middleware\AuthLogin;
use App\Http\Middleware\cekRole;
use App\Http\Middleware\CekRolePetugas;
use App\Http\Middleware\MultiRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => cekRole::class,
            'rolePetugas' => CekRolePetugas::class,
            'guest' => AuthLogin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
