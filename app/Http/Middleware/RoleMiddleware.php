<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check() && Auth::user()->role != 1) {
            // Redirect to a route that doesn't require the same middleware
            return redirect()->route('project-list'); // Instead of 'home', choose a route that doesn’t have role-based checks
        }
        return $next($request);
    }
}
