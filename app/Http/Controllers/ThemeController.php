<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

// ThemeController handles toggling between dark and light mode for the website
class ThemeController extends Controller
{
    /**
    * Toggle between dark and light mode
    *
    * @param \Illuminate\Http\Request $request The HTTP request object
    * @return \Illuminate\Http\Response Redirects back with the updated theme cookie
    *
    * This method checks the current theme from the cookie, switches it,
    * and sets a new cookie to remember the user's preference for 1 year.
    */
    public function toggle(Request $request)
    {
        // Get the current theme from the cookie, default to 'light'
        $theme = $request->cookie('theme', 'light');
        // Toggle the theme
        $newTheme = $theme === 'dark' ? 'light' : 'dark';

        // Set cookie for 1 year (525600 minutes)
        $cookie = Cookie::make('theme', $newTheme, 525600);

        // Redirect back to the previous page with the new theme cookie
        return redirect()->back()->withCookie($cookie);
    }
}