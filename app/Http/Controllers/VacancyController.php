<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

// VacancyController handles the logic for displaying the vacancies listing, vacancy detail, and processing vacancy-related data from the API
class VacancyController extends BaseController
{
    /**
     * Display the vacancies listing page with all required data from the API
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the current locale (language)
        $locale = app()->getLocale();
        $titleField = 'h_title_' . $locale;
        $descField = 'h_description_' . $locale;
        
        // Get header for vacancies page using the same approach as IndexController
        $headerResponse = $this->crudApiGet('/index/data', ['page_name' => 'vacancies']);
        $header = null;
        
        // Check if response was successful and contains header data
        if (isset($headerResponse['success']) && $headerResponse['success'] && isset($headerResponse['data']['header'])) {
            $header = $this->processHeader($headerResponse['data']['header']);
        }

        // Get department and experience data for filtering
        $departmentsResponse = $this->crudApiGet('/departments/all');
        $departments = [];
        if (isset($departmentsResponse['success']) && $departmentsResponse['success'] && isset($departmentsResponse['data'])) {
            foreach ($departmentsResponse['data'] as $department) {
                $departments[] = (object) $department;
            }
        }

        $experiencesResponse = $this->crudApiGet('/experiences/all');
        $experiences = [];
        if (isset($experiencesResponse['success']) && $experiencesResponse['success'] && isset($experiencesResponse['data'])) {
            foreach ($experiencesResponse['data'] as $experience) {
                $experiences[] = (object) $experience;
            }
        }

        // Create lookup arrays for efficient access
        $departmentLookup = [];
        foreach ($departments as $department) {
            $departmentLookup[$department->da_id] = $department;
        }

        $experienceLookup = [];
        foreach ($experiences as $experience) {
            $experienceLookup[$experience->ex_id] = $experience;
        }

        // Get active vacancies using the API endpoint
        $vacanciesResponse = $this->crudApiGet('/vacancies/active');
        $vacancies = [];
        
        if (isset($vacanciesResponse['success']) && $vacanciesResponse['success'] && isset($vacanciesResponse['data'])) {
            foreach ($vacanciesResponse['data'] as $vacancy) {
                // Process vacancy data and ensure all relationships are set
                $processedVacancy = $this->processVacancy($vacancy, $departmentLookup, $experienceLookup);
                $vacancies[] = $processedVacancy;
            }
        }

        // Return the vacancies view with the processed data
        return view('vacancies', [
            'header' => $header,
            'departments' => $departments,
            'experiences' => $experiences,
            'vacancies' => $vacancies
        ]);
    }

    /**
     * Display a specific vacancy detail by slug
     *
     * @param string $slug The vacancy slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $locale = app()->getLocale();
        
        // Get all active vacancies
        $vacanciesResponse = $this->crudApiGet('/vacancies/active');
        $foundVacancy = null;
        $allVacancies = [];
        
        if (isset($vacanciesResponse['success']) && $vacanciesResponse['success'] && isset($vacanciesResponse['data'])) {
            // Get lookup data for departments and experiences
            $departmentsResponse = $this->crudApiGet('/departments/all');
            $departmentLookup = [];
            if (isset($departmentsResponse['success']) && $departmentsResponse['success'] && isset($departmentsResponse['data'])) {
                foreach ($departmentsResponse['data'] as $department) {
                    $departmentLookup[$department['da_id']] = (object) $department;
                }
            }
            
            $experiencesResponse = $this->crudApiGet('/experiences/all');
            $experienceLookup = [];
            if (isset($experiencesResponse['success']) && $experiencesResponse['success'] && isset($experiencesResponse['data'])) {
                foreach ($experiencesResponse['data'] as $experience) {
                    $experienceLookup[$experience['ex_id']] = (object) $experience;
                }
            }
            
            // Loop through all vacancies to find the one matching the slug
            foreach ($vacanciesResponse['data'] as $vacancy) {
                $processedVacancy = $this->processVacancy($vacancy, $departmentLookup, $experienceLookup);
                $allVacancies[] = $processedVacancy;
                
                // Create slug based on current language
                $titleToUse = $locale === 'en' ? 
                    ($vacancy['v_title_en'] ?? $vacancy['v_title_id']) : 
                    ($vacancy['v_title_id'] ?? $vacancy['v_title_en']);
                $vacancySlug = Str::slug($titleToUse);
                
                if ($vacancySlug === $slug) {
                    // Found the vacancy by slug
                    $vacancyId = $vacancy['v_id'];
                    
                    // Get detailed vacancy info
                    $detailResponse = $this->crudApiGet('/vacancies/' . $vacancyId);
                    if (isset($detailResponse['success']) && $detailResponse['success'] && isset($detailResponse['data'])) {
                        $foundVacancy = $this->processVacancyDetail($detailResponse['data'], $departmentLookup, $experienceLookup);
                        // Add proper slug for current locale
                        $foundVacancy->slug = $vacancySlug;
                    }
                }
            }
        }
        
        // If vacancy not found, return 404
        if (!$foundVacancy) {
            return abort(404);
        }
        
        // Get other related vacancies (same department) for recommendations
        $relatedVacancies = [];
        $otherVacancies = array_filter($allVacancies, function($vacancy) use ($foundVacancy) {
            return ($vacancy->v_id !== $foundVacancy->v_id && 
                    $vacancy->v_department_id === $foundVacancy->v_department_id);
        });
        
        if (count($otherVacancies) > 0) {
            $otherVacancies = array_values($otherVacancies);
            shuffle($otherVacancies);
            $relatedVacancies = array_slice($otherVacancies, 0, min(3, count($otherVacancies)));
        }
        
        // Return the vacancy detail view with the found vacancy and related recommendations
        return view('vacancy-detail', [
            'vacancy' => $foundVacancy,
            'relatedVacancies' => $relatedVacancies
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
        
        // Add storage URL to image if it exists
        if (!empty($headerObj->h_image)) {
            $headerObj->h_image = config('app.storage_url') . '/' . $headerObj->h_image;
        }
        
        return $headerObj;
    }
    
    /**
     * Process vacancy data to add relationships and format fields
     *
     * @param array $vacancy The vacancy data from API
     * @param array $departmentLookup Department lookup table
     * @param array $experienceLookup Experience lookup table
     * @return object The processed vacancy object
     */
    private function processVacancy($vacancy, $departmentLookup = [], $experienceLookup = [])
    {
        // Convert array to object if not already
        $vacancyObj = is_array($vacancy) ? (object) $vacancy : $vacancy;

        // Create slug based on current language
        $locale = app()->getLocale();
        $titleToUse = $locale === 'en' ?
            ($vacancyObj->v_title_en ?? $vacancyObj->v_title_id) :
            ($vacancyObj->v_title_id ?? $vacancyObj->v_title_en);
        $vacancyObj->slug = Str::slug($titleToUse);

        // Initialize department and experience properties
        $vacancyObj->department_name_id = '';
        $vacancyObj->department_name_en = '';
        $vacancyObj->experience_name_id = '';
        $vacancyObj->experience_name_en = '';

        // Process department info
        if (isset($vacancyObj->department) && !empty($vacancyObj->department)) {
            $department = is_array($vacancyObj->department) ? (object) $vacancyObj->department : $vacancyObj->department;
            $vacancyObj->department_name_id = isset($department->da_title_id) ? trim($department->da_title_id) : '';
            $vacancyObj->department_name_en = isset($department->da_title_en) ? trim($department->da_title_en) : '';
        }
        else if (isset($vacancyObj->v_department_id) && !empty($departmentLookup)) {
            $departmentId = $vacancyObj->v_department_id;
            if (isset($departmentLookup[$departmentId])) {
                $department = $departmentLookup[$departmentId];
                $vacancyObj->department_name_id = $department->da_title_id ?? '';
                $vacancyObj->department_name_en = $department->da_title_en ?? '';
            }
        }

        // Process experience info
        if (isset($vacancyObj->experience) && !empty($vacancyObj->experience)) {
            $experience = is_array($vacancyObj->experience) ? (object) $vacancyObj->experience : $vacancyObj->experience;
            $vacancyObj->experience_name_id = isset($experience->ex_title_id) ? trim($experience->ex_title_id) : '';
            $vacancyObj->experience_name_en = isset($experience->ex_title_en) ? trim($experience->ex_title_en) : '';
        }
        else if (isset($vacancyObj->v_experience_id) && !empty($experienceLookup)) {
            $experienceId = $vacancyObj->v_experience_id;
            if (isset($experienceLookup[$experienceId])) {
                $experience = $experienceLookup[$experienceId];
                $vacancyObj->experience_name_id = $experience->ex_title_id ?? '';
                $vacancyObj->experience_name_en = $experience->ex_title_en ?? '';
            }
        }

        // Format posted and closed dates for display
        if (!empty($vacancyObj->v_posted_date)) {
            $vacancyObj->posted_date_formatted = date('d M Y', strtotime($vacancyObj->v_posted_date));
        }
        
        if (!empty($vacancyObj->v_closed_date)) {
            $vacancyObj->closed_date_formatted = date('d M Y', strtotime($vacancyObj->v_closed_date));
        } else {
            $vacancyObj->closed_date_formatted = 'Open';
        }

        return $vacancyObj;
    }
    
    /**
     * Process the vacancy detail data
     *
     * @param array $vacancy The vacancy data from API
     * @param array $departmentLookup Department lookup table
     * @param array $experienceLookup Experience lookup table
     * @return object The processed vacancy detail object
     */
    private function processVacancyDetail($vacancy, $departmentLookup = [], $experienceLookup = [])
    {
        return $this->processVacancy($vacancy, $departmentLookup, $experienceLookup);
    }
}