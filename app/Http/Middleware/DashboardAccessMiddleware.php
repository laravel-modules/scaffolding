<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DashboardAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
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
