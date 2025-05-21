<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ThemeController extends Controller
{
    /**
    * Toggle between dark and light mode
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function toggle(Request $request)
    {
        $theme = $request->cookie('theme', 'light');
        $newTheme = $theme === 'dark' ? 'light' : 'dark';

        // Set cookie for 1 year
        $cookie = Cookie::make('theme', $newTheme, 525600);

        return redirect()->back()->withCookie($cookie);
    }
}