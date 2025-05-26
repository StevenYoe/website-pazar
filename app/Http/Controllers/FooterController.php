<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class FooterController extends BaseController
{
    public function getFooterData()
    {
        // Get current locale
        $locale = App::getLocale();
        
        // Try to get data from cache first (with locale-specific cache)
        $cacheKey = 'footer_data_' . $locale;
        $useCache = false; // Set to true in production
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
                
                // Add locale-specific properties for easier access in views
                $footerItem->current_label = $locale == 'en' ? 
                    $footerItem->f_label_en : $footerItem->f_label_id;
                
                $footerItem->current_description = $locale == 'en' ? 
                    $footerItem->f_description_en : $footerItem->f_description_id;
                
                switch ($item['f_type']) {
                    case 'alamat':
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
        
        // Cache the data with locale-specific key
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