<?php

declare(strict_types = 1);

use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Middleware\ResolveSubdomain;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(EnsureUserIsActive::class);
        $middleware->prependToGroup('web', ResolveSubdomain::class);
        $middleware->alias(['resolve.subdomain' => ResolveSubdomain::class,]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
