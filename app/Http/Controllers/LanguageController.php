<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    /**
     * Change the application language
     */
    public function switch(Request $request, $locale)
    {
        // Check if the language exists in our list of available locales
        if (array_key_exists($locale, config('app.available_locales'))) {
            // Set the application locale
            App::setLocale($locale);
            // Store the locale in session
            Session::put('locale', $locale);
            
            // Get current URL and convert it to the new language
            $currentUrl = url()->previous();
            $newUrl = $this->convertUrlToLocale($currentUrl, $locale);
            
            return redirect($newUrl);
        }
        
        // Fallback to redirect back if locale not found
        return Redirect::back();
    }
    
    /**
     * Convert current URL to target locale URL
     */
    private function convertUrlToLocale($currentUrl, $targetLocale)
    {
        // URL mappings for different languages
        $urlMappings = [
            'en' => [
                'our-company' => 'perusahaan-kami',
                'our-brand' => 'brand-kami', 
                'products' => 'produk',
                'recipes' => 'resep',
                'career-info' => 'info-karir',
                'vacancies' => 'lowongan'
            ],
            'id' => [
                'perusahaan-kami' => 'our-company',
                'brand-kami' => 'our-brand',
                'produk' => 'products', 
                'resep' => 'recipes',
                'info-karir' => 'career-info',
                'lowongan' => 'vacancies'
            ]
        ];
        
        // Parse current URL
        $parsedUrl = parse_url($currentUrl);
        $path = trim($parsedUrl['path'] ?? '', '/');
        $pathSegments = explode('/', $path);
        
        // Remove current locale if it exists
        $currentLocale = in_array($pathSegments[0], ['en', 'id']) ? array_shift($pathSegments) : null;
        $route = implode('/', $pathSegments);
        
        // If no route (homepage), redirect to localized homepage
        if (empty($route)) {
            return url("/{$targetLocale}");
        }
        
        // Check if we need to map the route
        $currentSourceLocale = $currentLocale ?? app()->getLocale();
        
        // If switching from current locale, map the route
        if ($currentSourceLocale !== $targetLocale && isset($urlMappings[$currentSourceLocale][$route])) {
            $route = $urlMappings[$currentSourceLocale][$route];
        }
        // If switching to current locale from different locale, reverse map
        elseif (isset($urlMappings[$targetLocale]) && in_array($route, $urlMappings[$targetLocale])) {
            $route = array_search($route, $urlMappings[$targetLocale]);
        }
        
        return url("/{$targetLocale}/{$route}");
    }
}