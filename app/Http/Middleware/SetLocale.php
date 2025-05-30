<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Get locale from URL prefix
        $segment = $request->segment(1);
        
        if (in_array($segment, ['id', 'en'])) {
            App::setLocale($segment);
            Session::put('locale', $segment);
        } else {
            // Default to Indonesian if no prefix
            $defaultLocale = 'id';
            App::setLocale($defaultLocale);
            Session::put('locale', $defaultLocale);
        }
        
        return $next($request);
    }
}