<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'dashboard.access' => \App\Http\Middleware\DashboardAccessMiddleware::class,
            'dashboard.locales' => \App\Http\Middleware\DashboardLocaleMiddleware::class,
        ]);

        $middleware->group('dashboard', [
            'web',
            'auth',
            'dashboard.access',
            'dashboard.locales',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
