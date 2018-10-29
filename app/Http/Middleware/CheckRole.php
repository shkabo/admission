<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! \Auth::user()) {
            return redirect('login');
        }
        if (! $request->user()->hasRole($role)) {
           // return response('Unauthorized', 401);
            abort(403, 'Unauthorized request');
        }
        return $next($request);
    }
}
