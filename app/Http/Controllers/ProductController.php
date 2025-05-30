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
        // Get the current locale
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;
        
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
        
        // Create slug based on current language
        $locale = app()->getLocale();
        $titleToUse = $locale === 'en' ? 
            ($productObj->p_title_en ?? $productObj->p_title_id) : 
            ($productObj->p_title_id ?? $productObj->p_title_en);
        
        $productObj->slug = Str::slug($titleToUse);
        
        // Default empty category names
        $productObj->category_name_id = '';
        $productObj->category_name_en = '';
        
        // Process category relationship
        if (isset($productObj->category) && !empty($productObj->category)) {
            $category = is_array($productObj->category) ? (object) $productObj->category : $productObj->category;
            $productObj->category_name_id = isset($category->pc_title_id) ? trim($category->pc_title_id) : '';
            $productObj->category_name_en = isset($category->pc_title_en) ? trim($category->pc_title_en) : '';
        }
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
        $locale = app()->getLocale();
        
        // Get all active products
        $productsResponse = $this->crudApiGet('/products/getAllProducts', [
            'is_active' => true,
            'sort_by' => 'p_id',
            'sort_order' => 'asc'
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
                
                // Create slug based on current language
                $titleToUse = $locale === 'en' ? 
                    ($product['p_title_en'] ?? $product['p_title_id']) : 
                    ($product['p_title_id'] ?? $product['p_title_en']);
                $productSlug = Str::slug($titleToUse);
                
                if ($productSlug === $slug) {
                    // Found the product by slug
                    $productId = $product['p_id'];
                    
                    // Get detailed product info with all relations
                    $detailResponse = $this->crudApiGet('/products/' . $productId);
                    if (isset($detailResponse['success']) && $detailResponse['success'] && isset($detailResponse['data'])) {
                        $foundProduct = $this->processProductDetail($detailResponse['data']);
                        // Add proper slug for current locale
                        $foundProduct->slug = $productSlug;
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
            $otherProducts = array_values($otherProducts);
            shuffle($otherProducts);
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

    /**
     * Download catalog based on language
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function downloadCatalog(Request $request)
    {
        $locale = app()->getLocale();
        
        // Call API to get catalog
        $response = $this->crudApiGet('/productcatalogs/by-language', ['lang' => $locale]);
        
        if (!isset($response['success']) || !$response['success']) {
            return redirect()->back()->with('error', 'Catalog not available');
        }
        
        $catalogData = $response['data'];
        $fileUrl = $catalogData['file_url'];
        
        // Fix URL if it's pointing to localhost instead of backend server
        if (strpos($fileUrl, 'localhost') !== false) {
            // Replace localhost with backend server URL
            $backendUrl = config('app.storage_url', 'http://127.0.0.1:8002/storage');
            $fileUrl = str_replace('http://localhost/storage', $backendUrl, $fileUrl);
        }
        
        // Also handle if the URL is just relative path
        if (!filter_var($fileUrl, FILTER_VALIDATE_URL)) {
            $fileUrl = config('app.storage_url') . '/' . ltrim($fileUrl, '/');
        }
        
        // Simple redirect to corrected file URL
        return redirect($fileUrl);
    }
}