<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Just check if user is logged in as superadmin
        if (session('superadmin') === true) {
            return $next($request);
        }

        return redirect()->route('superadmin.login')->withErrors(['Access denied.']);
    }
}