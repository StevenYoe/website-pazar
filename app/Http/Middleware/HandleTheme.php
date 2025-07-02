<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

// HandleTheme middleware shares the current theme (dark or light) with all views
class HandleTheme
{
    /**
    * Handle an incoming request and share the theme with all views
    *
    * @param \Illuminate\Http\Request $request The HTTP request object
    * @param \Closure $next The next middleware or request handler
    * @return mixed
    *
    * This middleware retrieves the theme from the cookie (defaulting to 'light')
    * and makes it available to all views for consistent UI rendering.
    */
    public function handle(Request $request, Closure $next)
    {
        // Get theme from cookie or default to light
        $theme = $request->cookie('theme', 'light');

        // Share the theme with all views
        View::share('theme', $theme);

        // Continue to the next middleware or request handler
        return $next($request);
    }
}