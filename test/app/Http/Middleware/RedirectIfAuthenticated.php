<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

     //il middleware delle applicazioni è in app > http > kernel.php

    public function handle($request, Closure $next, $guard = null)
    {
        //se trova un token in sessione redireziona alla home
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        //in alternativa fai questo
        return $next($request);
    }
}
