<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    /**
     * Switch the application's locale and redirect to the localized version of the current page
     *
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang($locale)
    {
        // Validate that the locale exists
        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id'; // Default to Indonesian if invalid
        }
        
        // Store locale in session
        Session::put('locale', $locale);
        App::setLocale($locale);
        
        // Get the current route and parameters
        $route = request()->route()->getName();
        $parameters = request()->route()->parameters();
        
        // For routes that don't have names (unlikely in your case but for completeness)
        if (!$route) {
            return redirect()->back();
        }
        
        // Generate localized URL for the current route
        $localizedUrl = app('localizedRoute')($route, $parameters, $locale);
        
        // Redirect to the localized URL
        return redirect()->to($localizedUrl);
    }
}