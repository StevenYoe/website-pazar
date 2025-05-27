<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\VacancyController;
use app\Http\Controllers\LanguageController;
use app\Http\Controllers\ThemeController;
// use Illuminate\Support\Facades\Route;

// Language Switch route
Route::get('/language/{locale}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');

// Theme toggle route
Route::get('/theme/toggle', [App\Http\Controllers\ThemeController::class, 'toggle'])->name('theme.toggle');


// Homepage Route
Route::get('/', [IndexController::class, 'index'])->name('index');

// Company Routes
Route::get('/company', [CompanyController::class, 'index'])->name('company');

// Brand Routes
Route::get('/brand', [BrandController::class, 'index'])->name('brand');

// Products Routes
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Product detail page
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Recipes Routes
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');

// Recipe detail page
Route::get('/recipe/{slug}', [RecipeController::class, 'show'])->name('recipe.show');

// Career Routes
Route::get('/careerinfo', [CareerController::class, 'index'])->name('careerinfo');

// Vacancies Routes
Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancies');

// Vacancy detail page
Route::get('/vacancy/{slug}', [VacancyController::class, 'show'])->name('vacancy.show');

Route::get('/test-404', function () {
    abort(404);
});

Route::fallback(function () {
    return view('404');
});