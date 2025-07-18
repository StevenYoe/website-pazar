<?php
// Import all necessary controllers and Laravel Route facade
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

// Language Switch route (handles language switching)
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Theme toggle route (handles dark/light mode switching)
Route::get('/theme/toggle', [App\Http\Controllers\ThemeController::class, 'toggle'])->name('theme.toggle');

// Default redirect based on browser language preference
Route::get('/', function () {
    // Get browser language preference
    $acceptLanguage = request()->header('Accept-Language');
    $preferredLanguage = 'id'; // default to Indonesian
    
    if ($acceptLanguage) {
        // Parse Accept-Language header
        $languages = [];
        foreach (explode(',', $acceptLanguage) as $lang) {
            $parts = explode(';q=', trim($lang));
            $locale = trim($parts[0]);
            $quality = isset($parts[1]) ? (float) $parts[1] : 1.0;
            $languages[$locale] = $quality;
        }
        
        // Sort by quality
        arsort($languages);
        
        // Check for supported languages
        foreach ($languages as $locale => $quality) {
            // Check for exact match or language prefix
            if ($locale === 'id' || $locale === 'id-ID') {
                $preferredLanguage = 'id';
                break;
            } elseif ($locale === 'en' || strpos($locale, 'en-') === 0) {
                $preferredLanguage = 'en';
                break;
            }
        }
    }
    
    return redirect('/' . $preferredLanguage);
});

// Indonesian Routes (prefix: /id)
Route::prefix('id')->group(function () {
    // Home page
    Route::get('/', [IndexController::class, 'index'])->name('id.index');
    // Company page
    Route::get('/perusahaan-kami', [CompanyController::class, 'index'])->name('id.company');
    // Brand page
    Route::get('/brand-kami', [BrandController::class, 'index'])->name('id.brand');
    
    // Products listing and detail
    Route::get('/produk', [ProductController::class, 'index'])->name('id.products');
    Route::get('/produk/unduh-katalog', [ProductController::class, 'downloadCatalog'])->name('id.products.download-catalog');
    Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('id.product.show');
    
    // Recipes listing and detail
    Route::get('/resep', [RecipeController::class, 'index'])->name('id.recipes');
    Route::get('/resep/{slug}', [RecipeController::class, 'show'])->name('id.recipe.show');
    
    // Career info and vacancies
    Route::get('/info-karir', [CareerController::class, 'index'])->name('id.careerinfo');
    Route::get('/lowongan', [VacancyController::class, 'index'])->name('id.vacancies');
    Route::get('/lowongan/{slug}', [VacancyController::class, 'show'])->name('id.vacancy.show');
});

// English Routes (prefix: /en)
Route::prefix('en')->group(function () {
    // Home page
    Route::get('/', [IndexController::class, 'index'])->name('en.index');
    // Company page
    Route::get('/our-company', [CompanyController::class, 'index'])->name('en.company');
    // Brand page
    Route::get('/our-brand', [BrandController::class, 'index'])->name('en.brand');
    
    // Products listing and detail (note: product/{slug} for detail)
    Route::get('/products', [ProductController::class, 'index'])->name('en.products');
    Route::get('/products/download-catalog', [ProductController::class, 'downloadCatalog'])->name('en.products.download-catalog');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('en.product.show');
    
    // Recipes listing and detail (note: recipe/{slug} for detail)
    Route::get('/recipes', [RecipeController::class, 'index'])->name('en.recipes');
    Route::get('/recipe/{slug}', [RecipeController::class, 'show'])->name('en.recipe.show');
    
    // Career info and vacancies (note: vacancy/{slug} for detail)
    Route::get('/career-info', [CareerController::class, 'index'])->name('en.careerinfo');
    Route::get('/vacancies', [VacancyController::class, 'index'])->name('en.vacancies');
    Route::get('/vacancy/{slug}', [VacancyController::class, 'show'])->name('en.vacancy.show');
});

// Fallback routes for old URLs (redirect to new structure for backward compatibility)
Route::get('/company', function() { return redirect('/id/perusahaan-kami'); });
Route::get('/brand', function() { return redirect('/id/brand-kami'); });
Route::get('/products', function() { return redirect('/id/produk'); });
Route::get('/recipes', function() { return redirect('/id/resep'); });
Route::get('/careerinfo', function() { return redirect('/id/info-karir'); });
Route::get('/vacancies', function() { return redirect('/id/lowongan'); });

// Fallback for all other routes (shows custom 404 page)
Route::fallback(function () {
    return response()->view('404', [], 404);
});