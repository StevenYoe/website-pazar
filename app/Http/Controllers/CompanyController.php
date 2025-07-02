<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// CompanyController handles the logic for displaying the company page and processing company-related data from the API
class CompanyController extends BaseController
{
    /**
     * Display the company page with all required data from the API
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current locale (language)
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;
        
        // Use CRUD API to get company page data
        $response = $this->crudApiGet('/company/data');
        
        // Check if response was successful, otherwise show error
        if (!isset($response['success']) || !$response['success']) {
            return view('company')->with('error', $response['message'] ?? 'Failed to load company data');
        }
        
        // Prepare data for the view, processing images and converting arrays to objects
        $data = [
            // Header data - convert array to object if it exists and add storage URL to image
            'header' => isset($response['data']['header']) ? $this->processHeader($response['data']['header']) : null,
            
            // Company profile "what" section - convert array to object
            'companyWhat' => isset($response['data']['company_what']) ? $this->arrayToObject($response['data']['company_what']) : null,
            
            // History items - convert each item in array to object and add storage URL to images
            'histories' => isset($response['data']['histories']) ? 
                array_map([$this, 'processHistory'], $response['data']['histories']) : [],
            
            // Policy, Vision, Mission - convert arrays to objects
            'companyPolicy' => isset($response['data']['company_policy']) ? $this->arrayToObject($response['data']['company_policy']) : null,
            'companyVision' => isset($response['data']['company_vision']) ? $this->arrayToObject($response['data']['company_vision']) : null,
            'companyMission' => isset($response['data']['company_mission']) ? $this->arrayToObject($response['data']['company_mission']) : null,
        ];
        
        // Return the company view with the processed data
        return view('company', $data);
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
        
        // Add storage URL to image if it exists
        if (!empty($headerObj->h_image)) {
            $headerObj->h_image = config('app.storage_url') . '/' . $headerObj->h_image;
        }
        
        return $headerObj;
    }
    
    /**
     * Process the history data to add storage URL to image
     *
     * @param array $history The history data from API
     * @return object The processed history object
     */
    private function processHistory($history)
    {
        $historyObj = $this->arrayToObject($history);
        
        // Add storage URL to image if it exists
        if (!empty($historyObj->hs_image)) {
            $historyObj->hs_image = config('app.storage_url') . '/' . $historyObj->hs_image;
        }
        
        return $historyObj;
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
        
        $object = new \stdClass();
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