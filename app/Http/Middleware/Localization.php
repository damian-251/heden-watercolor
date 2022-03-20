<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

/*

Passing the locale for every site link might not be what you want and could look not quite so clean esthetically. 
That’s why we’ll perform language setup via a special language switcher and use the user session to display the translated content. 
Therefore, create a new middleware inside the app/Http/Middleware/Localization.php file or by running artisan make:middleware Localization.
*/


class Localization
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
        if (Session::has('locale')) {
            //Si ya hemos establecido el idioma lo usamos
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2); //Cogemos el lenguaje principal del navegador

            //Hay que tener en cuenta que el usuario tendrá alguna variable del Noruego (bokmal o nynorsk)
            if($locale == 'nb' || $locale == 'nn') {
                $locale = 'no';
            }

            //Si el idioma no está en idiomas disponibles el idioma en el que se pondrá la página será en inglés
            if (!in_array($locale, config('app.available_locales') )) {
                $locale = 'en';
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}

