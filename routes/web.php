<?php
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

// Language Switch route
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Theme toggle route
Route::post('/theme/toggle', [ThemeController::class, 'toggle'])->name('theme.toggle');

// Default redirect to Indonesian
Route::get('/', function () {
    return redirect('/id');
});

// Indonesian Routes
Route::prefix('id')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('id.index');
    Route::get('/perusahaan-kami', [CompanyController::class, 'index'])->name('id.company');
    Route::get('/brand-kami', [BrandController::class, 'index'])->name('id.brand');
    
    // Products
    Route::get('/produk', [ProductController::class, 'index'])->name('id.products');
    Route::get('/produk/unduh-katalog', [ProductController::class, 'downloadCatalog'])->name('id.products.download-catalog');
    Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('id.product.show');
    
    // Recipes
    Route::get('/resep', [RecipeController::class, 'index'])->name('id.recipes');
    Route::get('/resep/{slug}', [RecipeController::class, 'show'])->name('id.recipe.show');
    
    // Career
    Route::get('/info-karir', [CareerController::class, 'index'])->name('id.careerinfo');
    Route::get('/lowongan', [VacancyController::class, 'index'])->name('id.vacancies');
    Route::get('/lowongan/{slug}', [VacancyController::class, 'show'])->name('id.vacancy.show');
});

// English Routes
Route::prefix('en')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('en.index');
    Route::get('/our-company', [CompanyController::class, 'index'])->name('en.company');
    Route::get('/our-brand', [BrandController::class, 'index'])->name('en.brand');
    
    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('en.products');
    Route::get('/products/download-catalog', [ProductController::class, 'downloadCatalog'])->name('en.products.download-catalog');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('en.product.show');
    
    // Recipes
    Route::get('/recipes', [RecipeController::class, 'index'])->name('en.recipes');
    Route::get('/recipes/{slug}', [RecipeController::class, 'show'])->name('en.recipe.show');
    
    // Career
    Route::get('/career-info', [CareerController::class, 'index'])->name('en.careerinfo');
    Route::get('/vacancies', [VacancyController::class, 'index'])->name('en.vacancies');
    Route::get('/vacancies/{slug}', [VacancyController::class, 'show'])->name('en.vacancy.show');
});

// Fallback routes for old URLs (redirect to new structure)
Route::get('/company', function() { return redirect('/id/perusahaan-kami'); });
Route::get('/brand', function() { return redirect('/id/brand-kami'); });
Route::get('/products', function() { return redirect('/id/produk'); });
Route::get('/recipes', function() { return redirect('/id/resep'); });
Route::get('/careerinfo', function() { return redirect('/id/info-karir'); });
Route::get('/vacancies', function() { return redirect('/id/lowongan'); });

Route::fallback(function () {
    return view('404');
});