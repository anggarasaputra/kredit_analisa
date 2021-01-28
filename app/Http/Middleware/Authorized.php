<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Authorized
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
        if (!Auth::user())
        {
            return redirect()->intended(route('login'));
        }
        return $next($request);
    }
}
