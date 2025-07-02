@extends('master')

@section('title', __('general.vacancies') . ' - Pazar Seasonings')

@section('style')
<!-- Include vacancy and card height styles for consistent layout -->
<link href="{{ asset('css/vacancy.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

<!-- Vacancies Header Section: Displays the vacancies page banner with title and image -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <!-- Career label above the main title -->
            <p class="text-xl mb-2 text-yellow-400">{{ __('general.career') }}</p>
            <!-- Dynamic page title based on locale -->
            <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">
                {{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}
            </h1>
        </div>
        @if(isset($header->h_image))
        <div class="w-full max-w-2xl">
            <!-- Header image for the vacancies page -->
            <img src="{{ $header->h_image }}" alt="Vacancies-Header" class="rounded-lg shadow-lg w-full">
        </div>
        @endif
    </div>
</div>
@endsection

@section('content')
<!-- Vacancies Section: Shows filter options and job vacancy cards -->
<section class="py-12 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} vacancies-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <!-- Filter Section: Allows users to filter vacancies by department, employment type, and experience -->
        <div class="filters mb-12 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-200' }} rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.filter_vacancies') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Department Filter Dropdown -->
                <div class="filter-group">
                    <label for="department-filter" class="block text-sm font-medium {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-800' }} mb-2">{{ __('general.department') }}</label>
                    <select id="department-filter" class="block w-full py-2 px-3 border dark:text-black border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-custom-green focus:border-custom-green">
                        <option value="all">{{ __('general.all_departments') }}</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->da_id }}">
                                {{ app()->getLocale() == 'en' ? $department->da_title_en : $department->da_title_id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Employment Type Filter Dropdown -->
                <div class="filter-group">
                    <label for="employment-filter" class="block text-sm font-medium {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-800' }} mb-2">{{ __('general.work_model') }}</label>
                    <select id="employment-filter" class="block w-full py-2 px-3 border dark:text-black border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-custom-green focus:border-custom-green">
                        <option value="all">{{ __('general.all_work_models') }}</option>
                        @foreach($employments as $employment)
                            <option value="{{ $employment->e_id }}">
                                {{ app()->getLocale() == 'en' ? $employment->e_title_en : $employment->e_title_id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Experience Level Filter Dropdown -->
                <div class="filter-group">
                    <label for="experience-filter" class="block text-sm font-medium {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-800' }} mb-2">{{ __('general.experience') }}</label>
                    <select id="experience-filter" class="block w-full py-2 px-3 border dark:text-black border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-custom-green focus:border-custom-green">
                        <option value="all">{{ __('general.all_experiences') }}</option>
                        @foreach($experiences as $experience)
                            <option value="{{ $experience->ex_id }}">
                                {{ app()->getLocale() == 'en' ? $experience->ex_title_en : $experience->ex_title_id }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Vacancies Listing: Displays all available job vacancies -->
        <div id="vacancies-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(count($vacancies) > 0)
                @foreach($vacancies as $vacancy)
                    <!-- Vacancy card for each job opening -->
                    <div class="vacancy-item {{ $theme === 'dark' ? 'bg-gray-300' : 'bg-gray-100' }} rounded-lg shadow-sm flex flex-col border border-gray-200 overflow-hidden"
                        data-department="{{ $vacancy->v_department_id }}"
                        data-employment="{{ $vacancy->v_employment_id }}"
                        data-experience="{{ $vacancy->v_experience_id }}">
                        
                        @if(isset($vacancy->v_urgent) && $vacancy->v_urgent)
                        <!-- Urgent tag for high-priority vacancies -->
                        <div class="urgent-tag">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 23a7.5 7.5 0 01-5.138-12.963C8.204 8.774 11.5 6.5 11 1.5c6 4 9 8 3 14 1 0 2.5 0 5-2.47.27.773.5 1.604.5 2.47A7.5 7.5 0 0112 23z"></path>
                                </svg>
                                {{ __('general.urgently_needed') }}
                            </span>
                        </div>
                        @endif
                        
                        <div class="p-6 flex flex-col">
                            <h3 class="text-xl text-black font-bold mb-3 line-clamp-2">
                                {{ app()->getLocale() == 'en' ? $vacancy->v_title_en : $vacancy->v_title_id }}
                            </h3>
                            <div class="{{ $theme === 'dark' ? 'text-gray-800' : 'text-gray-600' }} mb-4 flex-grow">
                                <p class="mb-3"><span class="font-medium">{{ __('general.closing_date') }}</span> {{ $vacancy->closed_date_formatted }}</p>
                                
                                <div class="flex flex-col space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg>
                                        <span>
                                            {{ app()->getLocale() == 'en' ? $vacancy->department_name_en : $vacancy->department_name_id }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span>
                                            {{ app()->getLocale() == 'en' ? $vacancy->employment_name_en : $vacancy->employment_name_id }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 16v-4"></path>
                                            <path d="M12 8h.01"></path>
                                        </svg>
                                        <span>
                                            Min. {{ app()->getLocale() == 'en' ? $vacancy->experience_name_en : $vacancy->experience_name_id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route(app()->getLocale() . '.vacancy.show', $vacancy->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">
                                {{ __('general.see_more') }} →
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
            @endif
        </div>
        
        <!-- No Results Message: Appears if no vacancies match the filters -->
        <div id="no-results" class="hidden text-center py-10 col-span-full">
            <p class="text-lg text-gray-500">{{ __('general.no_vacancies') }}</p>
        </div>
    </div>
</section>
@endsection

@section('script')
<!-- Include scripts for vacancies page interactivity and filtering -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/vacancy.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection