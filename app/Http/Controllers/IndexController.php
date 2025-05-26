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
            'latestRecipe' => isset($response['data']['latest_recipe']) ? $this->processRecipe($response['data']['latest_recipe']) : null,
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
        
        // DEBUG: Log the recipe data to see structure
        \Log::info('=== PROCESSING RECIPE ===');
        \Log::info('Available keys in recipe object: ' . json_encode(array_keys((array) $recipeObj)));
        
        // Check if category data is already processed by the API
        if (isset($recipeObj->category_names) && !empty($recipeObj->category_names)) {
            // Category data is already processed by API
            \Log::info('Using pre-processed category data from API');
            \Log::info('Raw category_names type: ' . gettype($recipeObj->category_names));
            \Log::info('Raw category_names content: ' . json_encode($recipeObj->category_names));
            
            // Convert category_names to proper array of strings
            $categoryNamesArray = [];
            if (is_array($recipeObj->category_names) || is_object($recipeObj->category_names)) {
                foreach ($recipeObj->category_names as $categoryName) {
                    if (is_object($categoryName)) {
                        // If it's an object, try to extract string value
                        $categoryNamesArray[] = (string) $categoryName;
                    } else {
                        // If it's already a string, use it directly
                        $categoryNamesArray[] = (string) $categoryName;
                    }
                }
            } else {
                // If it's a single value, wrap it in array
                $categoryNamesArray = [(string) $recipeObj->category_names];
            }
            
            // Update category_names with properly converted array
            $recipeObj->category_names = $categoryNamesArray;
            
            // Set primary category name for backward compatibility
            if (isset($recipeObj->category_name) && !empty($recipeObj->category_name)) {
                // Use the category_name provided by API (ensure it's a string)
                $categoryNameString = is_object($recipeObj->category_name) ? 
                    (string) $recipeObj->category_name : 
                    (string) $recipeObj->category_name;
                
                $recipeObj->category_name_id = $categoryNameString;
                $recipeObj->category_name_en = $categoryNameString;
                $recipeObj->category_name = $categoryNameString;
            } else {
                // Use first category from category_names
                $firstCategory = $recipeObj->category_names[0] ?? ($locale == 'en' ? 'Uncategorized' : 'Tidak Berkategori');
                $recipeObj->category_name_id = $firstCategory;
                $recipeObj->category_name_en = $firstCategory;
                $recipeObj->category_name = $firstCategory;
            }
            
            // Initialize all_categories array for consistency
            $recipeObj->all_categories = [];
            
            \Log::info('Using API-provided category data - category_name: ' . ($recipeObj->category_name ?? 'N/A'));
            \Log::info('Final category names: ' . json_encode($recipeObj->category_names));
            
            return $recipeObj;
        }
        
        // If no pre-processed category data, try to process from relationships
        // Initialize category arrays
        $recipeObj->category_names = []; 
        $recipeObj->all_categories = []; 

        // Check different possible category data structures
        $categoryData = null;
        $categorySource = 'none';
        
        // Method 1: Check for 'categories' relationship (like in RecipeController)
        if (isset($recipeObj->categories) && !empty($recipeObj->categories)) {
            $categoryData = $recipeObj->categories;
            $categorySource = 'categories';
        }
        // Method 2: Check for 'recipe_categories' relationship
        elseif (isset($recipeObj->recipe_categories) && !empty($recipeObj->recipe_categories)) {
            $categoryData = $recipeObj->recipe_categories;
            $categorySource = 'recipe_categories';
        }
        // Method 3: Check for direct category fields
        elseif (isset($recipeObj->category) && !empty($recipeObj->category)) {
            $categoryData = [$recipeObj->category]; // Wrap single category in array
            $categorySource = 'category';
        }
        // Method 4: Check for flattened category data
        elseif (isset($recipeObj->rc_title_id) || isset($recipeObj->rc_title_en)) {
            // Category data is directly in recipe object
            $categoryData = [(object) [
                'rc_title_id' => $recipeObj->rc_title_id ?? '',
                'rc_title_en' => $recipeObj->rc_title_en ?? '',
                'rc_id' => $recipeObj->rc_id ?? null
            ]];
            $categorySource = 'flattened';
        }

        \Log::info('Category data source: ' . $categorySource);
        if ($categoryData) {
            \Log::info('Category data found: ' . json_encode($categoryData));
        }

        if ($categoryData) {
            $categoryNamesId = [];
            $categoryNamesEn = [];
            
            foreach ($categoryData as $index => $cat) {
                $category = is_array($cat) ? (object) $cat : $cat;
                
                // Store category data in array
                $recipeObj->all_categories[] = $category;
                
                // Add category names to arrays based on locale
                if (isset($category->rc_title_id) && !empty($category->rc_title_id)) {
                    $categoryNamesId[] = trim($category->rc_title_id);
                }
                if (isset($category->rc_title_en) && !empty($category->rc_title_en)) {
                    $categoryNamesEn[] = trim($category->rc_title_en);
                }
                
                // Set first category as primary (for backward compatibility)
                if ($index === 0) {
                    $recipeObj->category_name_id = isset($category->rc_title_id) && !empty($category->rc_title_id) ? 
                        trim($category->rc_title_id) : 'Tidak Berkategori';
                    $recipeObj->category_name_en = isset($category->rc_title_en) && !empty($category->rc_title_en) ? 
                        trim($category->rc_title_en) : 'Uncategorized';
                }
            }
            
            // Set category_names based on current locale
            $recipeObj->category_names = $locale == 'en' ? $categoryNamesEn : $categoryNamesId;
            
            // Set category_name for display (localized)
            $recipeObj->category_name = $locale == 'en' ? $recipeObj->category_name_en : $recipeObj->category_name_id;
        } else {
            // If no categories found in any structure, set default values
            $recipeObj->category_name_id = 'Tidak Berkategori';
            $recipeObj->category_name_en = 'Uncategorized';
            $recipeObj->category_name = $locale == 'en' ? 'Uncategorized' : 'Tidak Berkategori';
            $recipeObj->category_names = [$recipeObj->category_name];
            
            // Debug: Log when no categories are found
            \Log::warning('No categories found for recipe in IndexController', [
                'recipe_id' => $recipeObj->r_id ?? 'unknown',
                'available_keys' => array_keys((array) $recipeObj)
            ]);
        }
        
        \Log::info('Final category_name: ' . ($recipeObj->category_name ?? 'N/A'));
        \Log::info('Final category_names: ' . json_encode($recipeObj->category_names ?? []));
        
        return $recipeObj;
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