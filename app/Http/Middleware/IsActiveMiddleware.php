<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard): Response
    {
        if (auth($guard)->user()->status == '0') {
            auth($guard)->logout();
            return response()->json([
                'status' => 'failed',
                'message' => __('lang.inactive'),
            ], 422);
        }
        return $next($request);
    }
}
