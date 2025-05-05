<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Use CRUD API to get index page data
        $response = $this->crudApiGet('/index/data');
        
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
     * Process the recipe data to add storage URL to image
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
        
        return $recipeObj;
    }
    
    /**
     * Convert an array to an object recursively
     *
     * @param array $array The array to convert
     * @return object The converted object
     */
    private function arrayToObject($array)
    {
        if (!is_array($array)) {
            return $array;
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