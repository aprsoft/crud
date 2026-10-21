<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Aún no existe una ruta de acceso; evita el error Route [login] not defined.
        // Cuando se agregue, Laravel redirigirá automáticamente al formulario.
        $middleware->redirectGuestsTo(
            fn (): string => Route::has('login') ? route('login') : '/'
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
