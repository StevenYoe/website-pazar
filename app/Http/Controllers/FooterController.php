<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class FooterController extends BaseController
{
    /**
     * Get footer data for the master layout
     *
     * @return array
     */
    public function getFooterData()
    {
        // Try to get data from cache first
        // Temporarily disable cache for debugging
        $cacheKey = 'footer_data';
        $useCache = false; // Set to false to bypass cache during debugging
        
        if ($useCache && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Use CRUD API to get all footer data
        $response = $this->crudApiGet('/footers');
        
        // Check if response was successful
        if (!isset($response['success']) || !$response['success']) {
            $errorData = [
                'error' => $response['message'] ?? 'Failed to load footer data',
                'address' => null,
                'contacts' => [],
                'socials' => []
            ];
            
            return $errorData;
        }
        
        // Initialize arrays for different footer types
        $address = null;
        $contacts = [];
        $socials = [];
        
        // Process footer items by type
        if (isset($response['data']['data']) && is_array($response['data']['data'])) {
            foreach ($response['data']['data'] as $item) {
                $footerItem = $this->processFooterItem($item);
                
                switch ($item['f_type']) {
                    case 'alamat':
                        // Ensure the complete address is properly formatted
                        if (isset($footerItem->f_description_id)) {
                            // Make sure the description has no HTML tags or special characters that could affect display
                            $footerItem->f_description_id = trim($footerItem->f_description_id);
                        }
                        $address = $footerItem;
                        break;
                    case 'kontak':
                        $contacts[] = $footerItem;
                        break;
                    case 'social':
                        $socials[] = $footerItem;
                        break;
                }
            }
        }
        
        $footerData = [
            'address' => $address,
            'contacts' => $contacts,
            'socials' => $socials
        ];
        
        // For debugging
        if (isset($address->f_description_id)) {
            // Log the description to check its value
            // \Illuminate\Support\Facades\Log::info('Address description: ' . $address->f_description_id);
        }
        
        // Cache the data (only if useCache is true)
        if ($useCache) {
            Cache::put($cacheKey, $footerData, 60 * 60);
        }
        
        return $footerData;
    }
    
    /**
     * Process a footer item to add backend API URL to icon and convert to object
     *
     * @param array $item The footer item from API
     * @return object The processed footer object
     */
    private function processFooterItem($item)
    {
        $footerObj = $this->arrayToObject($item);
        
        if (!empty($footerObj->f_icon)) {
            $storageUrl = config('app.storage_url'); // Pastikan ini digunakan
            $storageUrl = rtrim($storageUrl, '/');
            $footerObj->f_icon = $storageUrl . '/' . ltrim($footerObj->f_icon, '/');
        }
        
        return $footerObj;
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