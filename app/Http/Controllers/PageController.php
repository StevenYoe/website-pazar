<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function index(){
		return view('index');
	}
 
	public function company(){
		return view('company');
	}
 
	public function history(){
		return view('history');
	}

    public function products(){
		return view('products');
	}
 
	public function careerinfo(){
		return view('careerinfo');
	}
 
	public function vacancies(){
		return view('vacancies');
	}

}
