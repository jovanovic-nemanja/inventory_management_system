<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserRoleIsBlog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->hasRole('blog')) {
            abort(404);
        }

        return $next($request);
    }
}
