<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsGuest
{
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            flash("Die pagina kun je alleen zien als je niet bent ingelogd.")->error();
            return redirect()->route("home");
        }
    
        return $next($request);
    }
}