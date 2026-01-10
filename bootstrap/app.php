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
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Throwable $e, $request) {
            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                $guards = $e->guards();
                if (in_array('admin', $guards)) {
                    return redirect('/admin/login');
                } elseif (auth('admin')->check()) {
                    return redirect('/admin/dashboard');
                } else {
                    return redirect('/sign-in');
                }
            }
        });
    })->create();
