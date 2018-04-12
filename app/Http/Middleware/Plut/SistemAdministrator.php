<?php

namespace App\Http\Middleware\Plut;

use Closure;

class SistemAdministrator
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
        if(Auth::user()->privilage == 1)
            return $next($request);
        return redirect()->back();
    }
}
