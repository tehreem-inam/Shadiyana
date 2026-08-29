<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    |
    | Restrict access to users having one of the allowed roles.
    |
    | Usage:
    |
    | ->middleware('role:superadmin')
    | ->middleware('role:vendor')
    | ->middleware('role:superadmin,vendor')
    |
    */

    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | Authentication Check
        |--------------------------------------------------------------------------
        */

        if (! $request->user()) {

            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.',
            ], 401);
        }


        /*
        |--------------------------------------------------------------------------
        | Role Check
        |--------------------------------------------------------------------------
        */

        if (! in_array(
            $request->user()->role,
            $roles,
            true
        )) {

            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to access this resource.',
            ], 403);
        }


        /*
        |--------------------------------------------------------------------------
        | Continue Request
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}