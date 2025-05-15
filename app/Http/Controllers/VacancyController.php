<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VacancyController extends BaseController
{
    /**
     * Display the vacancies listing page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get header for vacancies page using the same approach as IndexController
        $headerResponse = $this->crudApiGet('/index/data', ['page_name' => 'vacancies']);
        $header = null;
        
        // Check if response was successful and contains header data
        if (isset($headerResponse['success']) && $headerResponse['success'] && isset($headerResponse['data']['header'])) {
            $header = $this->processHeader($headerResponse['data']['header']);
        }

        // Get department, employment, and experience data for filtering
        $departmentsResponse = $this->crudApiGet('/departments/all');
        $departments = [];
        if (isset($departmentsResponse['success']) && $departmentsResponse['success'] && isset($departmentsResponse['data'])) {
            foreach ($departmentsResponse['data'] as $department) {
                $departments[] = (object) $department;
            }
        }

        $employmentsResponse = $this->crudApiGet('/employments/all');
        $employments = [];
        if (isset($employmentsResponse['success']) && $employmentsResponse['success'] && isset($employmentsResponse['data'])) {
            foreach ($employmentsResponse['data'] as $employment) {
                $employments[] = (object) $employment;
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

        $employmentLookup = [];
        foreach ($employments as $employment) {
            $employmentLookup[$employment->e_id] = $employment;
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
                // Process vacancy data
                $processedVacancy = $this->processVacancy($vacancy, $departmentLookup, $employmentLookup, $experienceLookup);
                $vacancies[] = $processedVacancy;
            }
        }

        return view('vacancies', [
            'header' => $header,
            'departments' => $departments,
            'employments' => $employments,
            'experiences' => $experiences,
            'vacancies' => $vacancies
        ]);
    }

    /**
     * Display a specific vacancy detail
     *
     * @param string $slug The vacancy slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Get all active vacancies
        $vacanciesResponse = $this->crudApiGet('/vacancies/active');
        $foundVacancy = null;
        $allVacancies = [];
        
        if (isset($vacanciesResponse['success']) && $vacanciesResponse['success'] && isset($vacanciesResponse['data'])) {
            // Get lookup data for departments, employments, and experiences
            $departmentsResponse = $this->crudApiGet('/departments/all');
            $departmentLookup = [];
            if (isset($departmentsResponse['success']) && $departmentsResponse['success'] && isset($departmentsResponse['data'])) {
                foreach ($departmentsResponse['data'] as $department) {
                    $departmentLookup[$department['da_id']] = (object) $department;
                }
            }
            
            $employmentsResponse = $this->crudApiGet('/employments/all');
            $employmentLookup = [];
            if (isset($employmentsResponse['success']) && $employmentsResponse['success'] && isset($employmentsResponse['data'])) {
                foreach ($employmentsResponse['data'] as $employment) {
                    $employmentLookup[$employment['e_id']] = (object) $employment;
                }
            }
            
            $experiencesResponse = $this->crudApiGet('/experiences/all');
            $experienceLookup = [];
            if (isset($experiencesResponse['success']) && $experiencesResponse['success'] && isset($experiencesResponse['data'])) {
                foreach ($experiencesResponse['data'] as $experience) {
                    $experienceLookup[$experience['ex_id']] = (object) $experience;
                }
            }
            
            foreach ($vacanciesResponse['data'] as $vacancy) {
                $processedVacancy = $this->processVacancy($vacancy, $departmentLookup, $employmentLookup, $experienceLookup);
                $allVacancies[] = $processedVacancy;
                
                $titleId = $vacancy['v_title_id'] ?? '';
                $titleEn = $vacancy['v_title_en'] ?? '';
                
                $titleToUse = !empty($titleId) ? $titleId : $titleEn;
                $vacancySlug = Str::slug($titleToUse);
                
                if ($vacancySlug === $slug) {
                    // Found the vacancy by slug
                    $vacancyId = $vacancy['v_id'];
                    
                    // Get detailed vacancy info
                    $detailResponse = $this->crudApiGet('/vacancies/' . $vacancyId);
                    
                    if (isset($detailResponse['success']) && $detailResponse['success'] && isset($detailResponse['data'])) {
                        $foundVacancy = $this->processVacancyDetail($detailResponse['data'], $departmentLookup, $employmentLookup, $experienceLookup);
                    }
                }
            }
        }
        
        if (!$foundVacancy) {
            return abort(404);
        }
        
        // Get other related vacancies (same department)
        $relatedVacancies = [];
        $otherVacancies = array_filter($allVacancies, function($vacancy) use ($foundVacancy) {
            return ($vacancy->v_id !== $foundVacancy->v_id && 
                    $vacancy->v_department_id === $foundVacancy->v_department_id);
        });
        
        if (count($otherVacancies) > 0) {
            // Reset array keys after filtering
            $otherVacancies = array_values($otherVacancies);
            // Shuffle the array of other vacancies
            shuffle($otherVacancies);
            // Take the first 3 (or less if there aren't 3 vacancies)
            $relatedVacancies = array_slice($otherVacancies, 0, min(3, count($otherVacancies)));
        }
        
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
        
        // Add storage URL to image if exists
        if (!empty($headerObj->h_image)) {
            $headerObj->h_image = config('app.storage_url') . '/' . $headerObj->h_image;
        }
        
        return $headerObj;
    }
    
    /**
     * Process vacancy data
     *
     * @param array $vacancy The vacancy data from API
     * @param array $departmentLookup Department lookup table
     * @param array $employmentLookup Employment lookup table
     * @param array $experienceLookup Experience lookup table
     * @return object The processed vacancy object
     */
    private function processVacancy($vacancy, $departmentLookup = [], $employmentLookup = [], $experienceLookup = [])
    {
        // Convert array to object if not already
        $vacancyObj = is_array($vacancy) ? (object) $vacancy : $vacancy;
        
        // Create slug from title
        $titleToUse = !empty($vacancyObj->v_title_id) ? $vacancyObj->v_title_id : $vacancyObj->v_title_en;
        $vacancyObj->slug = Str::slug($titleToUse);
        
        // Process department info
        if (isset($vacancyObj->department) && !empty($vacancyObj->department)) {
            // Department could be an object or array
            $department = is_array($vacancyObj->department) ? (object) $vacancyObj->department : $vacancyObj->department;
            
            $vacancyObj->department_name_id = isset($department->da_title_id) ? trim($department->da_title_id) : '';
            $vacancyObj->department_name_en = isset($department->da_title_en) ? trim($department->da_title_en) : '';
        } 
        // If relationship is missing but we have the ID and lookup table
        else if (isset($vacancyObj->v_department_id) && !empty($departmentLookup)) {
            $departmentId = $vacancyObj->v_department_id;
            
            if (isset($departmentLookup[$departmentId])) {
                $department = $departmentLookup[$departmentId];
                $vacancyObj->department_name_id = $department->da_title_id;
                $vacancyObj->department_name_en = $department->da_title_en;
            }
        }
        
        // Process employment info
        if (isset($vacancyObj->employment) && !empty($vacancyObj->employment)) {
            $employment = is_array($vacancyObj->employment) ? (object) $vacancyObj->employment : $vacancyObj->employment;
            
            $vacancyObj->employment_name_id = isset($employment->e_title_id) ? trim($employment->e_title_id) : '';
            $vacancyObj->employment_name_en = isset($employment->e_title_en) ? trim($employment->e_title_en) : '';
        } 
        else if (isset($vacancyObj->v_employment_id) && !empty($employmentLookup)) {
            $employmentId = $vacancyObj->v_employment_id;
            
            if (isset($employmentLookup[$employmentId])) {
                $employment = $employmentLookup[$employmentId];
                $vacancyObj->employment_name_id = $employment->e_title_id;
                $vacancyObj->employment_name_en = $employment->e_title_en;
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
                $vacancyObj->experience_name_id = $experience->ex_title_id;
                $vacancyObj->experience_name_en = $experience->ex_title_en;
            }
        }
        
        // Format dates
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
     * @param array $employmentLookup Employment lookup table
     * @param array $experienceLookup Experience lookup table
     * @return object The processed vacancy detail object
     */
    private function processVacancyDetail($vacancy, $departmentLookup = [], $employmentLookup = [], $experienceLookup = [])
    {
        return $this->processVacancy($vacancy, $departmentLookup, $employmentLookup, $experienceLookup);
    }
}