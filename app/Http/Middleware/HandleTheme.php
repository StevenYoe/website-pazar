<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HandleTheme
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
        // Get theme from cookie or default to light
        $theme = $request->cookie('theme', 'light');

        // Share the theme with all views
        View::share('theme', $theme);

        return $next($request);
    }
}