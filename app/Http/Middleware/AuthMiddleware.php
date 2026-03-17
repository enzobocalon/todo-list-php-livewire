<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() && !$request->routeIs('login', 'signup')) {
            return redirect()->route('login');
        }
        if (Auth::check() && $request->routeIs('login', 'signup')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
