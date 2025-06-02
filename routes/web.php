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
Route::get('/theme/toggle', [App\Http\Controllers\ThemeController::class, 'toggle'])->name('theme.toggle');

// Default redirect berdasarkan browser language
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
    
    // Products - CHANGED: products/{slug} -> product/{slug}
    Route::get('/products', [ProductController::class, 'index'])->name('en.products');
    Route::get('/products/download-catalog', [ProductController::class, 'downloadCatalog'])->name('en.products.download-catalog');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('en.product.show');
    
    // Recipes - CHANGED: recipes/{slug} -> recipe/{slug}
    Route::get('/recipes', [RecipeController::class, 'index'])->name('en.recipes');
    Route::get('/recipe/{slug}', [RecipeController::class, 'show'])->name('en.recipe.show');
    
    // Career - CHANGED: vacancies/{slug} -> vacancy/{slug}
    Route::get('/career-info', [CareerController::class, 'index'])->name('en.careerinfo');
    Route::get('/vacancies', [VacancyController::class, 'index'])->name('en.vacancies');
    Route::get('/vacancy/{slug}', [VacancyController::class, 'show'])->name('en.vacancy.show');
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