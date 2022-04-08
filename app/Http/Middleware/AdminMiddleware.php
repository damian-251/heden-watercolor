<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //Ponemos como condición que el usuario sea admin para pasar el filtro
        if(auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }else {
            return redirect('/'); //Si no es admin lo devolvemos a la página de inicio
        }
    }
}
