<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\VacancyController;
// use Illuminate\Support\Facades\Route;

// Homepage Route
Route::get('/', [IndexController::class, 'index'])->name('index');

// Company Routes
Route::get('/company', [CompanyController::class, 'index'])->name('company');

// Brand Routes
Route::get('/brand', [BrandController::class, 'index'])->name('brand');

// Products Routes
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');

// Product detail page
Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

// Recipes Routes
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');

// Recipe detail page
Route::get('/recipe/{slug}', [App\Http\Controllers\RecipeController::class, 'show'])->name('recipe.show');

// Career Routes
Route::get('/careerinfo', [CareerController::class, 'index'])->name('careerinfo');

// Vacancies Routes
Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancies');

// Vacancy detail page
Route::get('/vacancy/{slug}', [App\Http\Controllers\VacancyController::class, 'show'])->name('vacancy.show');