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
        $middleware->priority([
            'web',
            'frontend',
        ]);
        $middleware->appendToGroup('frontend', \ChinLeung\MultilingualRoutes\DetectRequestLocale::class);
        $middleware->appendToGroup('frontend', \App\Http\Middleware\PublicStatus::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
