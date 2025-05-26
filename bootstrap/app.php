<?php

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
        // Register the FooterDataMiddleware in the web middleware group
        $middleware->web(append: [
            \App\Http\Middleware\FooterDataMiddleware::class,
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\HandleTheme::class,
        ]);
        
        $middleware->alias([
            'localization' => \App\Http\Middleware\SetLocale::class,
        ]);

        // Your other middleware registrations...
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();