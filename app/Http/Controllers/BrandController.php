<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class BrandController extends BaseController
{
    /**
     * Display the brand page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current locale
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;
        
        // Use CRUD API to get brand page data
        $response = $this->crudApiGet('/brand/data');
        
        // Check if response was successful
        if (!isset($response['success']) || !$response['success']) {
            return view('brand')->with('error', $response['message'] ?? 'Failed to load brand data');
        }
        
        // Extract data from response for view
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
        
        // Add storage URL to image if exists
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
        
        // Add storage URL to image if exists
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
        
        // Add storage URL to image if exists
        if (!empty($certObj->c_image)) {
            $certObj->c_image = config('app.storage_url') . '/' . $certObj->c_image;
        }
        
        return $certObj;
    }
    
    /**
     * Process the testimonial data to add storage URL to image and handle gender fallback
     *
     * @param array $testimonial The testimonial data from API
     * @return object The processed testimonial object
     */
    private function processTestimonial($testimonial)
    {
        $testimonialObj = $this->arrayToObject($testimonial);
        
        // Add storage URL to image if exists
        if (!empty($testimonialObj->t_image)) {
            $testimonialObj->t_image = config('app.storage_url') . '/' . $testimonialObj->t_image;
        }
        
        // Add storage URL to profile image if exists
        if (!empty($testimonialObj->t_profile)) {
            $testimonialObj->t_profile = config('app.storage_url') . '/' . $testimonialObj->t_profile;
        } else {
            // Set default avatar based on gender for fallback
            $testimonialObj->t_profile = null; // We'll handle default in the view
        }
        
        return $testimonialObj;
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