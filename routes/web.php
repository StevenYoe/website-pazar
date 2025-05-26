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

// Language Switch route (outside locale group)
Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch');

// Theme toggle routes (outside locale group)
Route::get('/theme/toggle', [ThemeController::class, 'toggle'])
    ->name('theme.toggle');
Route::post('/theme/toggle', [ThemeController::class, 'toggle'])
    ->name('theme.toggle.post');

// Localized routes group
Route::group(['prefix' => '{locale?}', 'middleware' => 'localization', 'where' => ['locale' => 'en|id']], function () {
    // Homepage Route
    Route::get('/', [IndexController::class, 'index'])->name('index');
    
    // English routes
    Route::group(['middleware' => function ($request, $next) {
        if (app()->getLocale() === 'en') {
            return $next($request);
        }
        return redirect('/id' . $request->getPathInfo());
    }], function () {
        Route::get('/our-company', [CompanyController::class, 'index'])->name('company.en');
        Route::get('/our-brand', [BrandController::class, 'index'])->name('brand.en');
        Route::get('/products', [ProductController::class, 'index'])->name('products.en');
        Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.en');
        Route::get('/career-info', [CareerController::class, 'index'])->name('careerinfo.en');
        Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancies.en');
        
        // English detail routes
        Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show.en');
        Route::get('/recipe/{slug}', [RecipeController::class, 'show'])->name('recipe.show.en');
        Route::get('/vacancy/{slug}', [VacancyController::class, 'show'])->name('vacancy.show.en');
    });
    
    // Indonesian routes
    Route::group(['middleware' => function ($request, $next) {
        if (app()->getLocale() === 'id') {
            return $next($request);
        }
        return redirect('/en' . $request->getPathInfo());
    }], function () {
        Route::get('/perusahaan-kami', [CompanyController::class, 'index'])->name('company.id');
        Route::get('/brand-kami', [BrandController::class, 'index'])->name('brand.id');
        Route::get('/produk', [ProductController::class, 'index'])->name('products.id');
        Route::get('/resep', [RecipeController::class, 'index'])->name('recipes.id');
        Route::get('/info-karir', [CareerController::class, 'index'])->name('careerinfo.id');
        Route::get('/lowongan', [VacancyController::class, 'index'])->name('vacancies.id');
        
        // Indonesian detail routes
        Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show.id');
        Route::get('/resep/{slug}', [RecipeController::class, 'show'])->name('recipe.show.id');
        Route::get('/lowongan/{slug}', [VacancyController::class, 'show'])->name('vacancy.show.id');
    });
});

// Redirect from root to localized version
Route::get('/', function () {
    $locale = session('locale', config('app.locale', 'id'));
    return redirect('/' . $locale);
});