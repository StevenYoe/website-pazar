<?php
use App\Http\Controllers\PageController;
// use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// route website
Route::get('/company', [PageController::class, 'company'])->name('company');
Route::get('/brand', [PageController::class, 'brand'])->name('brand');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/recipes', [PageController::class, 'recipes'])->name('recipes');
Route::get('/careerinfo', [PageController::class, 'careerinfo'])->name('careerinfo');
Route::get('/vacancies', [PageController::class, 'vacancies'])->name('vacancies');