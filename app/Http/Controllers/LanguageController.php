<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    /**
    * Change the application language
    *
    * @param \Illuminate\Http\Request $request
    * @param string $locale
    * @return \Illuminate\Http\Response
    */
    public function switch(Request $request, $locale)
    {
        // Check if the language exists in our list of available locales
        if (array_key_exists($locale, config('app.available_locales'))) {
            Session::put('locale', $locale);
        }

        // Redirect back to the previous page
        return Redirect::back();
    }
}