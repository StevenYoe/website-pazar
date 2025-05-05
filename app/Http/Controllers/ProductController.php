<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends BaseController
{
    /**
     * Display the products page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get header for products page
        $headerResponse = $this->crudApiGet('/headers', ['page_name' => 'products']);
        $header = null;
        if (isset($headerResponse['success']) && $headerResponse['success'] && !empty($headerResponse['data'])) {
            // Look for header with h_page_name = 'products'
            foreach ($headerResponse['data'] as $headerItem) {
                if (isset($headerItem['h_page_name']) && $headerItem['h_page_name'] === 'products') {
                    $header = $this->processHeader($headerItem);
                    break;
                }
            }
        }

        // Get product categories for filter buttons
        $categoriesResponse = $this->crudApiGet('/productcategories/all');
        $categories = [];
        if (isset($categoriesResponse['success']) && $categoriesResponse['success'] && isset($categoriesResponse['data'])) {
            foreach ($categoriesResponse['data'] as $category) {
                $categories[] = $this->processCategory($category);
            }
        }

        // Get all products - Updated the endpoint
        $productsResponse = $this->crudApiGet('/products/getAllProducts');
        $products = [];
        if (isset($productsResponse['success']) && $productsResponse['success'] && isset($productsResponse['data'])) {
            foreach ($productsResponse['data'] as $product) {
                $products[] = $this->processProduct($product);
            }
        }

        // Log for debugging
        Log::info('Products fetch response', [
            'header_response' => $headerResponse,
            'categories_response' => $categoriesResponse,
            'products_response' => $productsResponse,
            'categories_count' => count($categories),
            'products_count' => count($products)
        ]);

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
     * @return object The processed product object
     */
    private function processProduct($product)
    {
        $productObj = (object) $product;
        
        // Add storage URL to image if exists
        if (!empty($productObj->p_image)) {
            $productObj->p_image = config('app.storage_url') . '/' . $productObj->p_image;
        }
        
        // Create slug from title_id or title_en
        $titleToUse = !empty($productObj->p_title_id) ? $productObj->p_title_id : $productObj->p_title_en;
        $productObj->slug = Str::slug($titleToUse);
        
        // Get category name if available
        if (isset($productObj->category) && !empty($productObj->category)) {
            $productObj->category_name_id = $productObj->category->pc_title_id ?? '';
            $productObj->category_name_en = $productObj->category->pc_title_en ?? '';
        } else {
            $productObj->category_name_id = '';
            $productObj->category_name_en = '';
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
        // Get all products - Updated the endpoint
        $productsResponse = $this->crudApiGet('/products/getAllProducts');
        $foundProduct = null;
        
        if (isset($productsResponse['success']) && $productsResponse['success'] && isset($productsResponse['data'])) {
            foreach ($productsResponse['data'] as $product) {
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
                        $foundProduct = $this->processProduct($detailResponse['data']);
                        
                        // Log product details for debugging
                        Log::info('Product detail loaded', [
                            'product_id' => $productId,
                            'slug' => $slug,
                            'has_detail' => isset($foundProduct->detail)
                        ]);
                    }
                    
                    break;
                }
            }
        }
        
        if (!$foundProduct) {
            Log::warning('Product not found', ['slug' => $slug]);
            return abort(404);
        }
        
        return view('product-detail', [
            'product' => $foundProduct
        ]);
    }
}