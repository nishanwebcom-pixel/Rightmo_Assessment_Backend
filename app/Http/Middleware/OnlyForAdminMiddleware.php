<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyForAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isset($request->user()->role_id) && $request->user()->role_id == config('constants.ROLES.ADMIN_ROLE')) {
            return $next($request);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }
    }
}
