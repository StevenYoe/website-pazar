<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

// SetLocale middleware sets the application's locale based on the URL prefix
class SetLocale
{
    /**
     * Handle an incoming request and set the locale
     *
     * @param \Illuminate\Http\Request $request The HTTP request object
     * @param \Closure $next The next middleware or request handler
     * @return mixed
     *
     * This middleware checks the first URL segment for a locale ('id' or 'en').
     * If found, it sets the application locale and stores it in the session.
     * If not found, it defaults to Indonesian ('id').
     */
    public function handle(Request $request, Closure $next)
    {
        // Get locale from URL prefix (first segment)
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
        
        // Continue to the next middleware or request handler
        return $next($request);
    }
}