<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class GerenteMiddleware
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
        if (Auth::check() && Auth::user()->rol_id == 4) {
          return $next($request);
        }
        return redirect('index');
    }
}
