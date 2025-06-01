<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function switch(Request $request, $locale)
    {
        if (!in_array($locale, ['id', 'en'])) {
            return redirect()->back();
        }
        
        App::setLocale($locale);
        Session::put('locale', $locale);
        
        // Get current route info
        $currentUrl = $request->header('referer');
        $newUrl = $this->convertUrlToNewLocale($currentUrl, $locale);
        
        return redirect($newUrl);
    }
    
    private function convertUrlToNewLocale($currentUrl, $targetLocale)
    {
        if (!$currentUrl) {
            return "/{$targetLocale}";
        }
        
        $parsedUrl = parse_url($currentUrl);
        $path = $parsedUrl['path'] ?? '/';
        
        // Remove current locale prefix and split path
        $pathSegments = explode('/', trim($path, '/'));
        $currentLocale = null;
        if (in_array($pathSegments[0] ?? '', ['id', 'en'])) {
            $currentLocale = array_shift($pathSegments);
        }
        
        // If no locale segments remain, redirect to homepage
        if (empty($pathSegments)) {
            return "/{$targetLocale}";
        }
        
        // URL mappings - Updated untuk singular detail
        $urlMappings = [
            'id' => [
                'perusahaan-kami' => 'our-company',
                'brand-kami' => 'our-brand',
                'produk' => 'products',
                'resep' => 'recipes',
                'info-karir' => 'career-info',
                'lowongan' => 'vacancies'
            ],
            'en' => [
                'our-company' => 'perusahaan-kami',
                'our-brand' => 'brand-kami',
                'products' => 'produk',
                'product' => 'produk', // Handle singular detail
                'recipes' => 'resep',
                'recipe' => 'resep', // Handle singular detail
                'career-info' => 'info-karir',
                'vacancies' => 'lowongan',
                'vacancy' => 'lowongan' // Handle singular detail
            ]
        ];
        
        // Convert first segment if needed
        if (!empty($pathSegments)) {
            $firstSegment = $pathSegments[0];
            $sourceLocale = $currentLocale ?: ($targetLocale === 'en' ? 'id' : 'en');
            
            if (isset($urlMappings[$sourceLocale][$firstSegment])) {
                $pathSegments[0] = $urlMappings[$sourceLocale][$firstSegment];
            }
            
            // Handle detail pages (product, recipe, vacancy)
            if (count($pathSegments) >= 2) {
                // For English to Indonesian detail pages, change singular to plural
                if ($targetLocale === 'id' && in_array($firstSegment, ['product', 'recipe', 'vacancy'])) {
                    // Keep the plural form for Indonesian
                    // produk, resep, lowongan are already plural
                }
                // For Indonesian to English detail pages, change to singular
                elseif ($targetLocale === 'en' && in_array($pathSegments[0], ['products', 'recipes', 'vacancies'])) {
                    $singularMap = [
                        'products' => 'product',
                        'recipes' => 'recipe', 
                        'vacancies' => 'vacancy'
                    ];
                    if (isset($singularMap[$pathSegments[0]])) {
                        $pathSegments[0] = $singularMap[$pathSegments[0]];
                    }
                }
                
                $this->translateDetailSlug($pathSegments, $currentLocale, $targetLocale);
            }
        }
        
        $newPath = '/' . $targetLocale . '/' . implode('/', $pathSegments);
        return rtrim($newPath, '/') ?: "/{$targetLocale}";
    }
    
    private function translateDetailSlug(&$pathSegments, $currentLocale, $targetLocale)
    {
        if (count($pathSegments) < 2) return;
        
        $section = $pathSegments[0];
        $slug = $pathSegments[1];
        
        // Check if this is a detail page - Updated untuk singular URLs
        $detailSections = ['produk', 'products', 'product', 'resep', 'recipes', 'recipe', 'lowongan', 'vacancies', 'vacancy'];
        if (!in_array($section, $detailSections)) return;
        
        try {
            // Determine API endpoint based on section
            $apiEndpoint = '';
            if (in_array($section, ['produk', 'products', 'product'])) {
                $apiEndpoint = '/products/getAllProducts';
            } elseif (in_array($section, ['resep', 'recipes', 'recipe'])) {
                $apiEndpoint = '/recipes/getAllRecipes';
            } elseif (in_array($section, ['lowongan', 'vacancies', 'vacancy'])) {
                $apiEndpoint = '/vacancies/active';
            }
            
            if (empty($apiEndpoint)) return;
            
            // Get data from API
            $baseController = new \App\Http\Controllers\BaseController();
            $response = $baseController->crudApiGet($apiEndpoint, ['is_active' => true]);
            
            if (!isset($response['success']) || !$response['success']) return;
            
            // Find item by current slug and get translated slug
            foreach ($response['data'] as $item) {
                // Create slugs for both languages
                $titleId = '';
                $titleEn = '';
                if (in_array($section, ['produk', 'products', 'product'])) {
                    $titleId = $item['p_title_id'] ?? '';
                    $titleEn = $item['p_title_en'] ?? '';
                } elseif (in_array($section, ['resep', 'recipes', 'recipe'])) {
                    $titleId = $item['r_title_id'] ?? '';
                    $titleEn = $item['r_title_en'] ?? '';
                } elseif (in_array($section, ['lowongan', 'vacancies', 'vacancy'])) {
                    $titleId = $item['v_title_id'] ?? '';
                    $titleEn = $item['v_title_en'] ?? '';
                }
                
                $slugId = Str::slug($titleId);
                $slugEn = Str::slug($titleEn);
                
                // Check if current slug matches
                if ($slug === $slugId || $slug === $slugEn) {
                    // Set new slug based on target locale
                    $pathSegments[1] = $targetLocale === 'en' ? $slugEn : $slugId;
                    break;
                }
            }
        } catch (\Exception $e) {
            // If translation fails, keep original slug
            \Log::warning('Slug translation failed: ' . $e->getMessage());
        }
    }
}