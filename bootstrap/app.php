<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// This file bootstraps the Laravel application and configures routing, middleware, and exception handling
return Application::configure(basePath: dirname(__DIR__))
    // Configure routing for web, console commands, and health check
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // Register global and aliased middleware
    ->withMiddleware(function (Middleware $middleware) {
        // Register the FooterDataMiddleware, SetLocale, and HandleTheme in the web middleware group
        $middleware->web(append: [
            \App\Http\Middleware\FooterDataMiddleware::class,
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\HandleTheme::class,
        ]);

        // Register an alias for the SetLocale middleware
        $middleware->alias([
            'localization' => \App\Http\Middleware\SetLocale::class,
        ]);
    })
    // Configure exception handling (currently empty)
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();