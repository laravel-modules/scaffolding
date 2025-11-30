<?php

namespace App\Http\Middleware;

use Closure;

class DashboardAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()->canAccessDashboard()) {
            abort(403);
        }

        return $next($request);
    }
}
