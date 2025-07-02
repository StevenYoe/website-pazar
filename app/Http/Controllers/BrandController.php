<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

// BrandController handles the logic for displaying the brand page and processing brand-related data from the API
class BrandController extends BaseController
{
    /**
     * Display the brand page with all required data from the API
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current locale (language)
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;
        
        // Use CRUD API to get brand page data
        $response = $this->crudApiGet('/brand/data');
        
        // Check if response was successful, otherwise show error
        if (!isset($response['success']) || !$response['success']) {
            return view('brand')->with('error', $response['message'] ?? 'Failed to load brand data');
        }
        
        // Prepare data for the view, processing images and converting arrays to objects
        $data = [
            // Header data - convert array to object if it exists and add storage URL to image
            'header' => isset($response['data']['header']) ? $this->processHeader($response['data']['header']) : null,
            
            // Why Pazar items - convert each item in array to object and add storage URL to images
            'whyPazarItems' => isset($response['data']['why_pazar_items']) ? 
                array_map([$this, 'processWhyPazarItem'], $response['data']['why_pazar_items']) : [],
            
            // Certification items - convert each item in array to object and add storage URL to images
            'certifications' => isset($response['data']['certifications']) ? 
                array_map([$this, 'processCertification'], $response['data']['certifications']) : [],
            
            // Testimonials - separated by type with complete profile information
            'customerTestimonials' => isset($response['data']['testimonials']['customer']) ? 
                array_map([$this, 'processTestimonial'], $response['data']['testimonials']['customer']) : [],
            'chefTestimonials' => isset($response['data']['testimonials']['chef']) ? 
                array_map([$this, 'processTestimonial'], $response['data']['testimonials']['chef']) : [],
        ];
        
        // Return the brand view with the processed data
        return view('brand', $data);
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
     * Process the Why Pazar item data to add storage URL to image
     *
     * @param array $item The Why Pazar item data from API
     * @return object The processed Why Pazar item object
     */
    private function processWhyPazarItem($item)
    {
        $itemObj = $this->arrayToObject($item);
        
        // Add storage URL to image if it exists
        if (!empty($itemObj->w_image)) {
            $itemObj->w_image = config('app.storage_url') . '/' . $itemObj->w_image;
        }
        
        return $itemObj;
    }
    
    /**
     * Process the certification data to add storage URL to image
     *
     * @param array $certification The certification data from API
     * @return object The processed certification object
     */
    private function processCertification($certification)
    {
        $certObj = $this->arrayToObject($certification);
        
        // Add storage URL to image if it exists
        if (!empty($certObj->c_image)) {
            $certObj->c_image = config('app.storage_url') . '/' . $certObj->c_image;
        }
        
        return $certObj;
    }
    
    /**
     * Process the testimonial data to add storage URL to image
     *
     * @param array $testimonial The testimonial data from API
     * @return object The processed testimonial object
     */
    private function processTestimonial($testimonial)
    {
        $testimonialObj = $this->arrayToObject($testimonial);
        
        // Add storage URL to image if it exists
        if (!empty($testimonialObj->t_image)) {
            $testimonialObj->t_image = config('app.storage_url') . '/' . $testimonialObj->t_image;
        }
        
        return $testimonialObj;
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