<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
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
        // Vérifier si la locale est définie dans la session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // Définir la locale par défaut si elle n'est pas définie
            $locale = config('app.locale', 'en');
        }

        // Définir la locale de l'application
        App::setLocale($locale);

        return $next($request);
    }
}
