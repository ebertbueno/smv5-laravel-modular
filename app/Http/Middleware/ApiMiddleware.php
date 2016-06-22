<?php

namespace App\Http\Middleware;

use Closure;
use Menu;
use Auth;

class ApiMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //
        // MENU
        //

        return $next($request);
    }
}