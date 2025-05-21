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
    * @param \Illuminate\Http\Request $request
    * @param \Closure $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next)
    {
        // If the user has selected a language and it's in the session, use it
        if (Session::has('locale') && array_key_exists(Session::get('locale'), config('app.available_locales'))) {
            App::setLocale(Session::get('locale'));
        }
        
        return $next($request);
    }
}