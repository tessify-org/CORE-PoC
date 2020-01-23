<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check())
        {
            flash("Je moet ingelogd zijn om die pagina te mogen bekijken.")->error();
            return redirect()->route("auth.login");
        }
    
        return $next($request);
    }
}