<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display the vacancies page
     *
     * @return \Illuminate\View\View
     */
    public function vacancies()
    {
        // Get all current job vacancies
        // You could add a Vacancy model and fetch real data here
        
        return view('vacancies');
    }
}
