<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ThemeController extends Controller
{
    /**
     * Toggle between dark and light mode via AJAX
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request)
    {
        $currentTheme = $request->cookie('theme', 'light');
        $newTheme = $currentTheme === 'dark' ? 'light' : 'dark';
        
        // Set cookie for 1 year
        $cookie = Cookie::make('theme', $newTheme, 525600);
        
        return response()->json([
            'success' => true,
            'theme' => $newTheme
        ])->withCookie($cookie);
    }
}