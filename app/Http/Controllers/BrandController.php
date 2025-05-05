<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display the brand page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can add brand-specific data fetching here
        return view('brand');
    }
}
