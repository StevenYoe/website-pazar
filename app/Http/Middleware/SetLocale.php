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
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if a locale parameter exists in the route
        if ($request->route('locale') && 
            array_key_exists($request->route('locale'), config('app.available_locales'))) {
            App::setLocale($request->route('locale'));
            Session::put('locale', $request->route('locale'));
        }
        // If not, check if the user has selected a language in the session
        elseif (Session::has('locale') && 
                array_key_exists(Session::get('locale'), config('app.available_locales'))) {
            App::setLocale(Session::get('locale'));
        }
        
        return $next($request);
    }
}