<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\FooterController;

class FooterDataMiddleware
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
        
        return $next($request);
    }
}