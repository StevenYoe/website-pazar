<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecipeController extends BaseController
{
    /**
     * Display the recipes page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current locale
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;
        
        // Get header for products page using the same approach as IndexController
        $headerResponse = $this->crudApiGet('/index/data', ['page_name' => 'recipes']);
        $header = null;
        if (isset($headerResponse['success']) && $headerResponse['success'] && isset($headerResponse['data']['header'])) {
            $header = $this->processHeader($headerResponse['data']['header']);
        }

        // Get recipe categories for filter buttons
        $categoriesResponse = $this->crudApiGet('/recipecategories/all');
        $categories = [];
        if (isset($categoriesResponse['success']) && $categoriesResponse['success'] && isset($categoriesResponse['data'])) {
            foreach ($categoriesResponse['data'] as $category) {
                $categories[] = $this->processCategory($category);
            }
        }

        // Create category lookup for efficient access
        $categoryLookup = [];
        foreach ($categories as $category) {
            $categoryLookup[$category->rc_id] = $category;
        }

        // Get all active recipes - Using the new getAllRecipes endpoint with parameters
        $recipesResponse = $this->crudApiGet('/recipes/getAllRecipes', [
            'is_active' => true,  // Only get active recipes
            'sort_by' => 'r_id',  // Sort by recipe ID
            'sort_order' => 'asc' // Sort in ascending order
        ]);
        $recipes = [];
        
        if (isset($recipesResponse['success']) && $recipesResponse['success'] && isset($recipesResponse['data'])) {
            foreach ($recipesResponse['data'] as $recipe) {
                // Process recipe and ensure category information is properly set
                $processedRecipe = $this->processRecipe($recipe, $categoryLookup);
                
                $recipes[] = $processedRecipe;
            }
        }

        return view('recipes', [
            'header' => $header,
            'categories' => $categories,
            'recipes' => $recipes
        ]);
    }

    /**
     * Process the header data to add storage URL to image
     *
     * @param array $header The header data from API
     * @return object The processed header object
     */
    private function processHeader($header)
    {
        $headerObj = (object) $header;
        
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
        $categoryObj = (object) $category;
        
        // Add storage URL to image if exists
        if (!empty($categoryObj->rc_image)) {
            $categoryObj->rc_image = config('app.storage_url') . '/' . $categoryObj->rc_image;
        }
        
        return $categoryObj;
    }
    
    /**
     * Process the recipe data to add storage URL to image and create slug
     *
     * @param array $recipe The recipe data from API
     * @param array $categoryLookup Optional lookup array of categories by ID
     * @return object The processed recipe object
     */
    private function processRecipe($recipe, $categoryLookup = [])
    {
        // Convert array to object if not already
        $recipeObj = is_array($recipe) ? (object) $recipe : $recipe;
        
        // Add storage URL to image if exists
        if (!empty($recipeObj->r_image)) {
            $recipeObj->r_image = config('app.storage_url') . '/' . $recipeObj->r_image;
        }
        
        // Create slug from title_id or title_en
        $titleToUse = !empty($recipeObj->r_title_id) ? $recipeObj->r_title_id : $recipeObj->r_title_en;
        $recipeObj->slug = Str::slug($titleToUse);
        
        // Default empty category values
        $recipeObj->category_name_id = 'Uncategorized';
        $recipeObj->category_name_en = 'Uncategorized';
        $recipeObj->category_names = []; // Array to store all category names
        $recipeObj->all_categories = []; // Array to store all category data
        
        // Process categories from relationship
        if (isset($recipeObj->categories) && !empty($recipeObj->categories)) {
            foreach ($recipeObj->categories as $index => $cat) {
                $category = is_array($cat) ? (object) $cat : $cat;
                
                // Store category data in array
                $recipeObj->all_categories[] = $category;
                
                // Add category names to array
                if (isset($category->rc_title_id) && !empty($category->rc_title_id)) {
                    $recipeObj->category_names[] = trim($category->rc_title_id);
                }
                
                // Set first category as primary (for backward compatibility)
                if ($index === 0) {
                    $recipeObj->category_name_id = isset($category->rc_title_id) ? trim($category->rc_title_id) : 'Uncategorized';
                    $recipeObj->category_name_en = isset($category->rc_title_en) ? trim($category->rc_title_en) : 'Uncategorized';
                }
            }
        } 
        
        return $recipeObj;
    }
    
    /**
     * Display recipe detail page
     * 
     * @param string $slug The recipe slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Get all active recipes - Using the new getAllRecipes endpoint with parameters
        $recipesResponse = $this->crudApiGet('/recipes/getAllRecipes', [
            'is_active' => true,  // Only get active recipes
            'sort_by' => 'r_id',  // Sort by recipe ID
            'sort_order' => 'asc' // Sort in ascending order
        ]);
        $foundRecipe = null;
        $allRecipes = [];
        
        if (isset($recipesResponse['success']) && $recipesResponse['success'] && isset($recipesResponse['data'])) {
            // Get categories for recipe processing
            $categoriesResponse = $this->crudApiGet('/recipecategories/all');
            $categoryLookup = [];
            
            if (isset($categoriesResponse['success']) && $categoriesResponse['success'] && isset($categoriesResponse['data'])) {
                foreach ($categoriesResponse['data'] as $category) {
                    $categoryObj = $this->processCategory($category);
                    $categoryLookup[$categoryObj->rc_id] = $categoryObj;
                }
            }
            
            foreach ($recipesResponse['data'] as $recipe) {
                $processedRecipe = $this->processRecipe($recipe, $categoryLookup);
                $allRecipes[] = $processedRecipe;
                
                $titleId = $recipe['r_title_id'] ?? '';
                $titleEn = $recipe['r_title_en'] ?? '';
                
                $titleToUse = !empty($titleId) ? $titleId : $titleEn;
                $recipeSlug = Str::slug($titleToUse);
                
                if ($recipeSlug === $slug) {
                    // Found the recipe by slug
                    $recipeId = $recipe['r_id'];
                    
                    // Get detailed recipe info with all relations
                    $detailResponse = $this->crudApiGet('/recipes/' . $recipeId);
                    
                    if (isset($detailResponse['success']) && $detailResponse['success'] && isset($detailResponse['data'])) {
                        $foundRecipe = $this->processRecipeDetail($detailResponse['data']);
                    }
                }
            }
        }
        
        if (!$foundRecipe) {
            return abort(404);
        }
        
        // Get random recipes (excluding current recipe)
        $randomRecipes = [];
        $otherRecipes = array_filter($allRecipes, function($recipe) use ($foundRecipe) {
            return ($recipe->r_id !== $foundRecipe->r_id);
        });
        
        if (count($otherRecipes) > 0) {
            // Reset array keys after filtering
            $otherRecipes = array_values($otherRecipes);
            // Shuffle the array of other recipes
            shuffle($otherRecipes);
            // Take the first 3 (or less if there aren't 3 recipes)
            $randomRecipes = array_slice($otherRecipes, 0, min(3, count($otherRecipes)));
        }
        
        return view('recipe-detail', [
            'recipe' => $foundRecipe,
            'randomRecipes' => $randomRecipes
        ]);
    }

    /**
     * Process the recipe detail data to convert array to object recursively
     *
     * @param array $recipe The recipe data from API
     * @return object The processed recipe object with detail as object
     */
    private function processRecipeDetail($recipe)
    {
        $recipeObj = $this->processRecipe($recipe);
        
        // Convert detail from array to object if it exists
        if (isset($recipeObj->detail) && !empty($recipeObj->detail)) {
            $recipeObj->detail = (object) $recipeObj->detail;
        }
        
        return $recipeObj;
    }
}