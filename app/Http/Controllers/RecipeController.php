<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display the company page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can add company-specific data fetching here
        return view('recipes');
    }
}
