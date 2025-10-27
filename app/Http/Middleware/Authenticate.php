<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Simple session check - if superadmin session exists, allow access
        if (session('superadmin') === true) {
            return $next($request);
        }

        return redirect()->route('superadmin.login');
    }
}