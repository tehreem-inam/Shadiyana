<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Middleware Aliases
        |--------------------------------------------------------------------------
        */

        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Guest Redirect
        |--------------------------------------------------------------------------
        */

        $middleware->redirectGuestsTo(function (Request $request) {

            if ($request->is('api/*')) {
                return null;
            }

            return route('login');
        });

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        /*
        |--------------------------------------------------------------------------
        | Unauthenticated API Requests
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            AuthenticationException $e,
            Request $request
        ) {

            if ($request->is('api/*')) {

                return response()->json([
                    'message' => 'Unauthorized. Please provide a valid authentication token.',
                ], 401);
            }

            return null;
        });


        /*
        |--------------------------------------------------------------------------
        | Validation Errors
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            ValidationException $e,
            Request $request
        ) {

            if ($request->is('api/*')) {

                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => $e->errors(),
                ], 422);
            }

            return null;
        });


        /*
        |--------------------------------------------------------------------------
        | General API Exceptions
        |--------------------------------------------------------------------------
        */

        $exceptions->render(function (
            Throwable $e,
            Request $request
        ) {

            if ($request->is('api/*')) {

                return response()->json([
                    'message' => 'An unexpected error occurred.',
                ], 500);
            }

            return null;
        });

    })

    ->create();