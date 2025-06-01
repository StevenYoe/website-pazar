<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use stdClass;

class IndexController extends BaseController
{
    /**
     * Display the index/homepage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current locale
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;

        // Use CRUD API to get index page data
        // Specify that we want the index page header specifically
        $response = $this->crudApiGet('/index/data', ['page_name' => 'index']);

        // Check if response was successful
        if (!isset($response['success']) || !$response['success']) {
            return view('index')->with('error', $response['message'] ?? 'Failed to load index data');
        }

        // Extract data from response for view
        $data = [
            // Popup data - convert array to object if it exists and add storage URL to image
            'popup' => isset($response['data']['popup']) ? $this->processPopup($response['data']['popup']) : null,
            
            // Header data - convert array to object if it exists and add storage URL to image
            'header' => isset($response['data']['header']) ? $this->processHeader($response['data']['header']) : null,
            
            // Product categories - convert each item in array to object and add storage URL to images
            'productCategories' => isset($response['data']['product_categories']) ?
                array_map([$this, 'processCategory'], $response['data']['product_categories']) : [],
            
            // Why Pazar items - convert each item in array to object and add storage URL to images
            'whyPazarItems' => isset($response['data']['why_pazar_items']) ?
                array_map([$this, 'processWhyPazarItem'], $response['data']['why_pazar_items']) : [],

            // Latest recipe - convert array to object if it exists and add storage URL to image
            'latestRecipe' => isset($response['data']['latest_recipe']) ? 
                $this->processRecipe($response['data']['latest_recipe']) : null,
        ];

        return view('index', $data);
    }

    /**
     * Process the popup data to add storage URL to image
     *
     * @param array $popup The popup data from API
     * @return object The processed popup object
     */
    private function processPopup($popup)
    {
        $popupObj = $this->arrayToObject($popup);
        
        // Add storage URL to image if exists
        if (!empty($popupObj->pu_image)) {
            $popupObj->pu_image = config('app.storage_url') . '/' . $popupObj->pu_image;
        }
        
        return $popupObj;
    }

    /**
     * Process the header data to add storage URL to image
     *
     * @param array $header The header data from API
     * @return object The processed header object
     */
    private function processHeader($header)
    {
        $headerObj = $this->arrayToObject($header);
        
        // Add storage URL to image if exists
        if (!empty($headerObj->h_image)) {
            $headerObj->h_image = config('app.storage_url') . '/' . $headerObj->h_image;
        }
        
        return $headerObj;
    }

    /**
     * Process the category data to add storage URL to image
     *
     * @param array $category The category data from API
     * @return object The processed category object
     */
    private function processCategory($category)
    {
        $categoryObj = $this->arrayToObject($category);
        
        // Add storage URL to image if exists
        if (!empty($categoryObj->pc_image)) {
            $categoryObj->pc_image = config('app.storage_url') . '/' . $categoryObj->pc_image;
        }
        
        return $categoryObj;
    }

    /**
     * Process the Why Pazar item data to add storage URL to image
     *
     * @param array $item The Why Pazar item data from API
     * @return object The processed Why Pazar item object
     */
    private function processWhyPazarItem($item)
    {
        $itemObj = $this->arrayToObject($item);
        
        // Add storage URL to image if exists
        if (!empty($itemObj->w_image)) {
            $itemObj->w_image = config('app.storage_url') . '/' . $itemObj->w_image;
        }
        
        return $itemObj;
    }

    /**
     * Process the recipe data to add storage URL to image and create slug
     * FIXED: Now properly handles category localization
     *
     * @param array $recipe The recipe data from API
     * @return object The processed recipe object
     */
    private function processRecipe($recipe)
    {
        $recipeObj = $this->arrayToObject($recipe);
        
        // Add storage URL to image if exists
        if (!empty($recipeObj->r_image)) {
            $recipeObj->r_image = config('app.storage_url') . '/' . $recipeObj->r_image;
        } else {
            // Set default image if r_image is empty
            $recipeObj->r_image = asset('img/Recipes/default-recipe.jpg');
        }

        // Get current locale for creating proper slug and category names
        $locale = app()->getLocale();
        
        // Create slug from title
        $titleToUse = !empty($recipeObj->r_title_id) ? $recipeObj->r_title_id : $recipeObj->r_title_en;
        $recipeObj->slug = Str::slug($titleToUse);

        // FIXED SOLUTION: Get categories from API separately to ensure proper localization
        $this->processRecipeCategoriesWithLocale($recipeObj, $locale);

        return $recipeObj;
    }

    /**
     * Process recipe categories with proper locale handling
     * This method fetches category data separately to ensure localization works correctly
     *
     * @param object $recipeObj The recipe object to process
     * @param string $locale Current locale
     * @return void
     */
    private function processRecipeCategoriesWithLocale($recipeObj, $locale)
    {
        // Initialize default values
        $recipeObj->category_names = [];
        $recipeObj->all_categories = [];
        $recipeObj->category_name_id = $locale == 'en' ? 'Uncategorized' : 'Tidak Berkategori';
        $recipeObj->category_name_en = 'Uncategorized';
        $recipeObj->category_name = $locale == 'en' ? 'Uncategorized' : 'Tidak Berkategori';

        // Try to get detailed recipe data with categories
        if (isset($recipeObj->r_id)) {
            try {
                $detailResponse = $this->crudApiGet('/recipes/' . $recipeObj->r_id);
                
                if (isset($detailResponse['success']) && $detailResponse['success'] && 
                    isset($detailResponse['data']['categories']) && !empty($detailResponse['data']['categories'])) {
                    
                    $categories = $detailResponse['data']['categories'];
                    $categoryNamesId = [];
                    $categoryNamesEn = [];
                    
                    foreach ($categories as $index => $category) {
                        $catObj = is_array($category) ? (object) $category : $category;
                        
                        // Store category data
                        $recipeObj->all_categories[] = $catObj;
                        
                        // Extract localized category names
                        if (isset($catObj->rc_title_id) && !empty($catObj->rc_title_id)) {
                            $categoryNamesId[] = trim($catObj->rc_title_id);
                        }
                        if (isset($catObj->rc_title_en) && !empty($catObj->rc_title_en)) {
                            $categoryNamesEn[] = trim($catObj->rc_title_en);
                        }
                        
                        // Set first category as primary
                        if ($index === 0) {
                            $recipeObj->category_name_id = isset($catObj->rc_title_id) && !empty($catObj->rc_title_id) ? 
                                trim($catObj->rc_title_id) : 'Tidak Berkategori';
                            $recipeObj->category_name_en = isset($catObj->rc_title_en) && !empty($catObj->rc_title_en) ? 
                                trim($catObj->rc_title_en) : 'Uncategorized';
                        }
                    }
                    
                    // Set category_names based on current locale
                    $recipeObj->category_names = $locale == 'en' ? $categoryNamesEn : $categoryNamesId;
                    
                    // Set display category name based on locale
                    $recipeObj->category_name = $locale == 'en' ? $recipeObj->category_name_en : $recipeObj->category_name_id;
                    
                    \Log::info('Successfully processed categories for recipe ID: ' . $recipeObj->r_id, [
                        'locale' => $locale,
                        'category_names_id' => $categoryNamesId,
                        'category_names_en' => $categoryNamesEn,
                        'final_category_names' => $recipeObj->category_names,
                        'display_category_name' => $recipeObj->category_name
                    ]);
                    
                    return; // Success, exit early
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to fetch detailed recipe categories: ' . $e->getMessage(), [
                    'recipe_id' => $recipeObj->r_id
                ]);
            }
        }

        // Fallback: Try to process existing category data if available
        if (isset($recipeObj->categories) && !empty($recipeObj->categories)) {
            $categoryNamesId = [];
            $categoryNamesEn = [];
            
            foreach ($recipeObj->categories as $index => $cat) {
                $category = is_array($cat) ? (object) $cat : $cat;
                
                $recipeObj->all_categories[] = $category;
                
                if (isset($category->rc_title_id) && !empty($category->rc_title_id)) {
                    $categoryNamesId[] = trim($category->rc_title_id);
                }
                if (isset($category->rc_title_en) && !empty($category->rc_title_en)) {
                    $categoryNamesEn[] = trim($category->rc_title_en);
                }
                
                if ($index === 0) {
                    $recipeObj->category_name_id = isset($category->rc_title_id) && !empty($category->rc_title_id) ? 
                        trim($category->rc_title_id) : 'Tidak Berkategori';
                    $recipeObj->category_name_en = isset($category->rc_title_en) && !empty($category->rc_title_en) ? 
                        trim($category->rc_title_en) : 'Uncategorized';
                }
            }
            
            $recipeObj->category_names = $locale == 'en' ? $categoryNamesEn : $categoryNamesId;
            $recipeObj->category_name = $locale == 'en' ? $recipeObj->category_name_en : $recipeObj->category_name_id;
        }
        
        // Final fallback: Use pre-processed data if it exists but re-localize it
        elseif (isset($recipeObj->category_names) && !empty($recipeObj->category_names)) {
            // The pre-processed category_names might be in Indonesian, we need to get the English versions
            if ($locale == 'en') {
                // Try to fetch all recipe categories to create a mapping
                try {
                    $categoriesResponse = $this->crudApiGet('/recipecategories/all');
                    if (isset($categoriesResponse['success']) && $categoriesResponse['success'] && 
                        isset($categoriesResponse['data'])) {
                        
                        $categoryMapping = [];
                        foreach ($categoriesResponse['data'] as $category) {
                            $categoryMapping[$category['rc_title_id']] = $category['rc_title_en'];
                        }
                        
                        // Convert existing category names to English
                        $englishCategoryNames = [];
                        foreach ($recipeObj->category_names as $categoryName) {
                            $englishCategoryNames[] = $categoryMapping[$categoryName] ?? $categoryName;
                        }
                        
                        $recipeObj->category_names = $englishCategoryNames;
                        $recipeObj->category_name = $englishCategoryNames[0] ?? 'Uncategorized';
                        
                    }
                } catch (\Exception $e) {
                    \Log::warning('Failed to translate category names: ' . $e->getMessage());
                }
            }
        }

        \Log::info('Final category processing result', [
            'recipe_id' => $recipeObj->r_id ?? 'unknown',
            'locale' => $locale,
            'category_name' => $recipeObj->category_name,
            'category_names' => $recipeObj->category_names
        ]);
    }

    /**
     * Convert an array to an object recursively
     * Preserves arrays of primitive values (strings, numbers, booleans)
     *
     * @param array $array The array to convert
     * @return object The converted object
     */
    private function arrayToObject($array)
    {
        if (!is_array($array)) {
            return $array;
        }

        // Check if this is an indexed array of primitive values
        if (array_keys($array) === range(0, count($array) - 1)) {
            // This is an indexed array, check if all values are primitives
            $allPrimitives = true;
            foreach ($array as $value) {
                if (is_array($value) || is_object($value)) {
                    $allPrimitives = false;
                    break;
                }
            }
            // If all values are primitives, return as array to preserve it
            if ($allPrimitives) {
                return $array;
            }
        }

        $object = new stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $object->$key = $this->arrayToObject($value);
            } else {
                $object->$key = $value;
            }
        }

        return $object;
    }
}