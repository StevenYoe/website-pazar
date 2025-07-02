<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\FooterController;

// FooterDataMiddleware injects footer data into all views for every request
class FooterDataMiddleware
{
    /**
     * Handle an incoming request and share footer data with all views
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request object
     * @param  \Closure  $next The next middleware or request handler
     * @return mixed
     *
     * This middleware retrieves footer data from FooterController and shares it with all views.
     * If an error occurs, it shares an empty data structure to prevent view errors.
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Get footer data from FooterController
            $footerController = new FooterController();
            $footerData = $footerController->getFooterData();
            
            // Share footer data with all views
            View::share('footerData', $footerData);
        } catch (\Exception $e) {
            // Share empty data structure with views to prevent errors
            View::share('footerData', [
                'address' => null,
                'contacts' => [],
                'socials' => []
            ]);
        }
        
        // Continue to the next middleware or request handler
        return $next($request);
    }
}