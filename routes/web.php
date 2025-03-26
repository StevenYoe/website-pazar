<?php
use App\Http\Controllers\PageController;
// use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// route website
Route::get('/company', [PageController::class, 'company'])->name('company');
Route::get('/history', [PageController::class, 'history'])->name('history');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/careerinfo', [PageController::class, 'careerinfo'])->name('careerinfo');
Route::get('/vacancies', [PageController::class, 'vacancies'])->name('vacancies');