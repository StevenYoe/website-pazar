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
 
	public function brand(){
		return view('brand');
	}
 
	public function products(){
		return view('products');
	}

    public function recipes(){
		return view('recipes');
	}
 
	public function careerinfo(){
		return view('careerinfo');
	}
 
	public function vacancies(){
		return view('vacancies');
	}

}
