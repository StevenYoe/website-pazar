<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// CareerController handles the logic for displaying the career info page and processing career-related data from the API
class CareerController extends BaseController
{
    /**
     * Display the career info page with all required data from the API
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current locale (language)
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;
        
        // Use CRUD API to get career page data
        $response = $this->crudApiGet('/career/data');
        
        // Check if response was successful, otherwise show error
        if (!isset($response['success']) || !$response['success']) {
            return view('careerinfo')->with('error', $response['message'] ?? 'Failed to load career data');
        }
        
        // Prepare data for the view, processing images and converting arrays to objects
        $data = [
            // Header data - convert array to object if it exists and add storage URL to image
            'header' => isset($response['data']['header']) ? $this->processHeader($response['data']['header']) : null,
            
            // Work at Pazar "work" section - convert array to object
            'workAtPazarWork' => isset($response['data']['work_at_pazar_work']) ? $this->arrayToObject($response['data']['work_at_pazar_work']) : null,
            
            // Work at Pazar "why" section - convert array to object
            'workAtPazarWhy' => isset($response['data']['work_at_pazar_why']) ? $this->arrayToObject($response['data']['work_at_pazar_why']) : null,
            
            // Work at Pazar "join" section - convert array to object
            'workAtPazarJoin' => isset($response['data']['work_at_pazar_join']) ? $this->arrayToObject($response['data']['work_at_pazar_join']) : null,
            
            // Career info items - convert each item in array to object and add storage URL to images
            'careerInfos' => isset($response['data']['career_infos']) ? 
                array_map([$this, 'processCareerInfo'], $response['data']['career_infos']) : [],
        ];
        
        // For debugging: Uncomment the line below to inspect the API response and processed data
        // dd($response, $data);
        
        // Return the careerinfo view with the processed data
        return view('careerinfo', $data);
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
     * Process the career info data to add storage URL to image
     *
     * @param array $careerInfo The career info data from API
     * @return object The processed career info object
     */
    private function processCareerInfo($careerInfo)
    {
        $careerInfoObj = $this->arrayToObject($careerInfo);
        
        // Add storage URL to image if it exists
        if (!empty($careerInfoObj->ci_image)) {
            $careerInfoObj->ci_image = config('app.storage_url') . '/' . $careerInfoObj->ci_image;
        }
        
        return $careerInfoObj;
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