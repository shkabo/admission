<?php

namespace App\Http\Middleware;

use Closure;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null, $roles = null)
    {
        $roles = explode('|', $roles);
        if (Auth::guard($guard)->guest() OR !in_array(Auth::guard($guard)->user()->role_id, $roles)) {
            return response('Unauthorized', 401);
        }
        return $next($request);
    }
}
