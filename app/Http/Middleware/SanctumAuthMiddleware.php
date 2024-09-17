<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanctumAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if (! $request->user() || ! $request->user()->tokenCan('your-scope-here')) {
        //     return response()->json([
        //         'response' => Response::HTTP_UNAUTHORIZED,
        //         'success' => false,
        //         'message' => 'Unauthorized',
        //     ], Response::HTTP_UNAUTHORIZED);
        // }
        return $next($request);
    }
}
