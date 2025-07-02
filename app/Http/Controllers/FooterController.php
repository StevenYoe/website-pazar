<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

// FooterController handles the logic for retrieving and processing footer data for the master layout
class FooterController extends BaseController
{
    /**
     * Get footer data for the master layout
     *
     * @return array Footer data including address, contacts, and socials
     *
     * This method retrieves footer data from the API, processes it, and returns it in a structured format.
     * It also supports caching for performance, which can be toggled for debugging.
     */
    public function getFooterData()
    {
        // Try to get data from cache first (disabled for debugging)
        $cacheKey = 'footer_data';
        $useCache = false; // Set to true to enable cache
        
        if ($useCache && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Use CRUD API to get all footer data
        $response = $this->crudApiGet('/footers');
        
        // Check if response was successful, otherwise return error data
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
        
        // Process footer items by type (address, contacts, socials)
        if (isset($response['data']['data']) && is_array($response['data']['data'])) {
            foreach ($response['data']['data'] as $item) {
                $footerItem = $this->processFooterItem($item);
                
                switch ($item['f_type']) {
                    case 'alamat':
                        // Ensure the complete address is properly formatted
                        if (isset($footerItem->f_description_id)) {
                            // Remove unwanted characters from the address description
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
        
        // Structure the footer data for the view
        $footerData = [
            'address' => $address,
            'contacts' => $contacts,
            'socials' => $socials
        ];
        
        // For debugging: Uncomment to log the address description
        // if (isset($address->f_description_id)) {
        //     \Illuminate\Support\Facades\Log::info('Address description: ' . $address->f_description_id);
        // }
        
        // Cache the data for 1 hour if caching is enabled
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
     *
     * This method adds the storage URL to the icon path and converts the array to an object.
     */
    private function processFooterItem($item)
    {
        $footerObj = $this->arrayToObject($item);
        
        // Add storage URL to icon if it exists
        if (!empty($footerObj->f_icon)) {
            $storageUrl = config('app.storage_url');
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
     *
     * This helper function recursively converts an array to a stdClass object.
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