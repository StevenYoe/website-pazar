<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    /**
     * Display the products page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get header for products page using the same approach as IndexController
        $headerResponse = $this->crudApiGet('/index/data', ['page_name' => 'products']);
        $header = null;
        
        // Check if response was successful and contains header data
        if (isset($headerResponse['success']) && $headerResponse['success'] && isset($headerResponse['data']['header'])) {
            $header = $this->processHeader($headerResponse['data']['header']);
        }

        // Get product categories for filter buttons
        $categoriesResponse = $this->crudApiGet('/productcategories/all');
        $categories = [];
        if (isset($categoriesResponse['success']) && $categoriesResponse['success'] && isset($categoriesResponse['data'])) {
            foreach ($categoriesResponse['data'] as $category) {
                $categories[] = $this->processCategory($category);
            }
        }

        // Create category lookup for efficient access
        $categoryLookup = [];
        foreach ($categories as $category) {
            $categoryLookup[$category->pc_id] = $category;
        }

        // Get all products - Using the updated endpoint with additional parameters
        $productsResponse = $this->crudApiGet('/products/getAllProducts', [
            'is_active' => true,  // Only get active products
            'sort_by' => 'p_id',  // Sort by product ID
            'sort_order' => 'asc' // Sort in ascending order
        ]);
        $products = [];
        
        if (isset($productsResponse['success']) && $productsResponse['success'] && isset($productsResponse['data'])) {
            // Debug the raw response to see what we're getting
            
            foreach ($productsResponse['data'] as $product) {
                // Process product and ensure category information is properly set
                $processedProduct = $this->processProduct($product, $categoryLookup);
                
                $products[] = $processedProduct;
            }
        }

        return view('products', [
            'header' => $header,
            'categories' => $categories,
            'products' => $products
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
        if (!empty($categoryObj->pc_image)) {
            $categoryObj->pc_image = config('app.storage_url') . '/' . $categoryObj->pc_image;
        }
        
        return $categoryObj;
    }
    
    /**
     * Process the product data to add storage URL to image and create slug
     *
     * @param array $product The product data from API
     * @param array $categoryLookup Optional lookup array of categories by ID
     * @return object The processed product object
     */
    private function processProduct($product, $categoryLookup = [])
    {
        // Convert array to object if not already
        $productObj = is_array($product) ? (object) $product : $product;
        
        // Add storage URL to image if exists
        if (!empty($productObj->p_image)) {
            $productObj->p_image = config('app.storage_url') . '/' . $productObj->p_image;
        }
        
        // Create slug from title_id or title_en
        $titleToUse = !empty($productObj->p_title_id) ? $productObj->p_title_id : $productObj->p_title_en;
        $productObj->slug = Str::slug($titleToUse);
        
        // Default empty category names
        $productObj->category_name_id = '';
        $productObj->category_name_en = '';
        
        // Try getting category from relationship first - API might return category as 'category' property
        if (isset($productObj->category) && !empty($productObj->category)) {
            // Category could be an object or array
            $category = is_array($productObj->category) ? (object) $productObj->category : $productObj->category;
            
            // Extract category names from relationship
            $productObj->category_name_id = isset($category->pc_title_id) ? trim($category->pc_title_id) : '';
            $productObj->category_name_en = isset($category->pc_title_en) ? trim($category->pc_title_en) : '';
        } 
        // If relationship is missing but we have the category ID and lookup table
        else if (isset($productObj->p_id_product_category) && !empty($categoryLookup)) {
            $categoryId = $productObj->p_id_product_category;
            
            if (isset($categoryLookup[$categoryId])) {
                $category = $categoryLookup[$categoryId];
                $productObj->category_name_id = $category->pc_title_id;
                $productObj->category_name_en = $category->pc_title_en;
            } 
        } 
        return $productObj;
    }
    
    /**
     * Display product detail page
     * 
     * @param string $slug The product slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Get all active products - Updated the endpoint with parameters
        $productsResponse = $this->crudApiGet('/products/getAllProducts', [
            'is_active' => true,  // Only get active products
            'sort_by' => 'p_id',  // Sort by product ID
            'sort_order' => 'asc' // Sort in ascending order
        ]);
        $foundProduct = null;
        $allProducts = [];
        
        if (isset($productsResponse['success']) && $productsResponse['success'] && isset($productsResponse['data'])) {
            // Get categories for product processing
            $categoriesResponse = $this->crudApiGet('/productcategories/all');
            $categoryLookup = [];
            
            if (isset($categoriesResponse['success']) && $categoriesResponse['success'] && isset($categoriesResponse['data'])) {
                foreach ($categoriesResponse['data'] as $category) {
                    $categoryObj = $this->processCategory($category);
                    $categoryLookup[$categoryObj->pc_id] = $categoryObj;
                }
            }
            
            foreach ($productsResponse['data'] as $product) {
                $processedProduct = $this->processProduct($product, $categoryLookup);
                $allProducts[] = $processedProduct;
                
                $titleId = $product['p_title_id'] ?? '';
                $titleEn = $product['p_title_en'] ?? '';
                
                $titleToUse = !empty($titleId) ? $titleId : $titleEn;
                $productSlug = Str::slug($titleToUse);
                
                if ($productSlug === $slug) {
                    // Found the product by slug
                    $productId = $product['p_id'];
                    
                    // Get detailed product info with all relations
                    $detailResponse = $this->crudApiGet('/products/' . $productId);
                    
                    if (isset($detailResponse['success']) && $detailResponse['success'] && isset($detailResponse['data'])) {
                        $foundProduct = $this->processProductDetail($detailResponse['data']);
                    }
                }
            }
        }
        
        if (!$foundProduct) {
            return abort(404);
        }
        
        // Get random products (excluding current product)
        $randomProducts = [];
        $otherProducts = array_filter($allProducts, function($product) use ($foundProduct) {
            return ($product->p_id !== $foundProduct->p_id);
        });
        
        if (count($otherProducts) > 0) {
            // Reset array keys after filtering
            $otherProducts = array_values($otherProducts);
            // Shuffle the array of other products
            shuffle($otherProducts);
            // Take the first 4 (or less if there aren't 4 products)
            $randomProducts = array_slice($otherProducts, 0, min(4, count($otherProducts)));
        }
        
        return view('product-detail', [
            'product' => $foundProduct,
            'randomProducts' => $randomProducts
        ]);
    }

    /**
     * Process the product detail data to convert array to object recursively
     *
     * @param array $product The product data from API
     * @return object The processed product object with detail as object
     */
    private function processProductDetail($product)
    {
        $productObj = $this->processProduct($product);
        
        // Convert detail from array to object if it exists
        if (isset($productObj->detail) && !empty($productObj->detail)) {
            $productObj->detail = (object) $productObj->detail;
        }
        
        return $productObj;
    }
}