<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessToDashboard
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
        if (auth()->check())
            if (auth()->user()->type == "admin")
            return $next($request);

        abort(403);

    }
}
