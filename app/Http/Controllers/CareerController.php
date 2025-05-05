<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display the career info page
     *
     * @return \Illuminate\View\View
     */
    public function info()
    {
        // You can add career info specific data fetching here
        return view('careerinfo');
    }
}
