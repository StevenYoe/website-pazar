@extends('master')

@section('title', (app()->getLocale() == 'en' ? $vacancy->v_title_en : $vacancy->v_title_id) . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/vacancy.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('header')
<!-- Override with empty header to remove default landing content -->
<div class="vacancy-detail-header"></div>
@endsection

@section('content')
<!-- Vacancy Detail Section -->
<section class="py-12 {{ $theme === 'dark' ? 'bg-gray-900 text-gray-400' : 'bg-white text-gray-black' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <!-- Breadcrumb Navigation -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' }} hover:text-custom-green">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            {{ __('general.home') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ url('/vacancies') }}" class="ml-1 text-sm font-medium {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' }} hover:text-custom-green">{{ __('general.vacancies') }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium {{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }} md:ml-2">
                                {{ app()->getLocale() == 'en' ? $vacancy->v_title_en : $vacancy->v_title_id }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-md p-6 relative">
                <!-- Urgent Tag at top left corner -->
                @if(isset($vacancy->v_urgent) && $vacancy->v_urgent)
                <div class="urgent-tag">
                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-100 text-red-800">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 23a7.5 7.5 0 01-5.138-12.963C8.204 8.774 11.5 6.5 11 1.5c6 4 9 8 3 14 1 0 2.5 0 5-2.47.27.773.5 1.604.5 2.47A7.5 7.5 0 0112 23z"></path>
                        </svg>
                        {{ __('general.urgently_needed') }}
                    </span>
                </div>
                @endif
                
                <!-- Vacancy Header -->
                <div class="mb-4">
                    <h1 class="text-3xl font-bold {{ $theme === 'dark' ? 'text-white' : 'text-gray-900' }}">
                        {{ app()->getLocale() == 'en' ? $vacancy->v_title_en : $vacancy->v_title_id }}
                    </h1>
                </div>

                <!-- Vacancy Details -->
                <div class="mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span class="{{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' }}">{{ __('general.closing_date') }}<span class="font-medium"> {{ $vacancy->closed_date_formatted }}</span></span>
                        </div>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold {{ $theme === 'dark' ? 'text-white' : 'text-black' }} mb-2">{{ __('general.job_description') }}</h2>
                    <div class="prose prose-sm sm:prose lg:prose-lg max-w-none dark:prose-dark">
                        {{ app()->getLocale() == 'en' ? $vacancy->v_description_en : $vacancy->v_description_id }}
                    </div>
                </div>

                <!-- Job Responsibilities -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold {{ $theme === 'dark' ? 'text-white' : 'text-black' }} mb-2">{{ __('general.main_responsibilities') }}</h2>
                    <div class="prose prose-sm sm:prose lg:prose-lg max-w-none dark:prose-dark">
                        {{ app()->getLocale() == 'en' ? $vacancy->v_responsibilities_en : $vacancy->v_responsibilities_id }}
                    </div>
                </div>

                <!-- Job Requirements -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold {{ $theme === 'dark' ? 'text-white' : 'text-black' }} mb-2">{{ __('general.qualifications') }}</h2>
                    <div class="prose prose-sm sm:prose lg:prose-lg max-w-none dark:prose-dark">
                        {{ app()->getLocale() == 'en' ? $vacancy->v_requirement_en : $vacancy->v_requirement_id }}
                    </div>
                </div>

                <!-- Apply Button -->
                <div class="mt-6">
                    <a href="mailto:careers@company.com?subject=Application for {{ $vacancy->v_title_id }}" class="inline-block bg-custom-green hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                        {{ __('general.apply_now') }}
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Job Summary -->
                <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-bold {{ $theme === 'dark' ? 'text-white' : 'text-black' }} mb-4">{{ __('general.job_details') }}</h3>
                    <ul class="space-y-3">
                        <!-- Department info -->
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-custom-green mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                            <div>
                                <span class="block text-sm {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.department') }}</span>
                                <span class="{{ $theme === 'dark' ? 'text-gray-200' : 'text-gray-800' }}">
                                    {{ app()->getLocale() == 'en' ? $vacancy->department_name_en : $vacancy->department_name_id }}
                                </span>
                            </div>
                        </li>
                        <!-- Job type info -->
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-custom-green mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <div>
                                <span class="block text-sm {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.job_type') }}</span>
                                <span class="{{ $theme === 'dark' ? 'text-gray-200' : 'text-gray-800' }}">
                                    {{ app()->getLocale() == 'en' ? $vacancy->v_type : $vacancy->v_type }}
                                </span>
                            </div>
                        </li>
                        <!-- Work model info -->
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-custom-green mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                <line x1="6" y1="18" x2="6.01" y2="18"></line>
                            </svg>
                            <div>
                                <span class="block text-sm {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.work_model') }}</span>
                                <span class="{{ $theme === 'dark' ? 'text-gray-200' : 'text-gray-800' }}">
                                    {{ app()->getLocale() == 'en' ? $vacancy->employment_name_en : $vacancy->employment_name_id }}
                                </span>
                            </div>
                        </li>
                        <!-- Experience info -->
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-custom-green mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 16v-4"></path>
                                <path d="M12 8h.01"></path>
                            </svg>
                            <div>
                                <span class="block text-sm {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.experience') }}</span>
                                <span class="{{ $theme === 'dark' ? 'text-gray-200' : 'text-gray-800' }}">
                                    {{ app()->getLocale() == 'en' ? $vacancy->experience_name_en : $vacancy->experience_name_id }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Share Job -->
                <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-bold {{ $theme === 'dark' ? 'text-white' : 'text-black' }} mb-4">{{ __('general.share_vacancy') }}</h3>
                    <div class="share-buttons">
                        <!-- Facebook -->
                        <button type="button" class="share-btn facebook" onclick="shareVacancy('facebook')">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path>
                            </svg>
                        </button>
                        
                        <!-- LinkedIn -->
                        <button type="button" class="share-btn linkedin" onclick="shareVacancy('linkedin')">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
                            </svg>
                        </button>
                        
                        <!-- WhatsApp -->
                        <button type="button" class="share-btn whatsapp" onclick="shareVacancy('whatsapp')">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                            </svg>
                        </button>
                        
                        <!-- X (Twitter) -->
                        <button type="button" class="share-btn x-twitter" onclick="shareVacancy('twitter')">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M13.6823 10.6218L20.2391 3H18.6854L12.9921 9.61788L8.44486 3H3.2002L10.0765 13.0074L3.2002 21H4.75404L10.7663 14.0113L15.5525 21H20.7971L13.6819 10.6218H13.6823ZM11.5541 13.0956L10.8574 12.0991L5.31391 4.16971H7.70053L12.1742 10.5689L12.8709 11.5655L18.6861 19.8835H16.2995L11.5541 13.096V13.0956Z"></path>
                            </svg>
                        </button>
                        
                        <!-- Copy Link -->
                        <button type="button" class="share-btn copy-link" onclick="copyVacancyLink()">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                            </svg>
                            <span class="link-copied-tooltip">{{ __('general.link_copied') }}</span>
                        </button>
                    </div>
                </div>

                <!-- Related Vacancies -->
                @if(count($relatedVacancies) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                        {{ __('general.related_vacancies') }}
                    </h3>
                    <div class="vacancies-item">
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($relatedVacancies as $related)
                            <div class="vacancy-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col border border-gray-200 overflow-hidden"
                                data-department="{{ $related->v_department_id }}"
                                data-employment="{{ $related->v_employment_id }}"
                                data-experience="{{ $related->v_experience_id }}">
                                
                                @if(isset($related->v_urgent) && $related->v_urgent)
                                <div class="urgent-tag">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-100 text-red-800">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M12 23a7.5 7.5 0 01-5.138-12.963C8.204 8.774 11.5 6.5 11 1.5c6 4 9 8 3 14 1 0 2.5 0 5-2.47.27.773.5 1.604.5 2.47A7.5 7.5 0 0112 23z"></path>
                                        </svg>
                                        {{ __('general.urgently_needed') }}
                                    </span>
                                </div>
                                @endif
                                
                                <div class="p-6 flex flex-col card-container">
                                    <h3 class="text-xl text-black font-bold mb-3 line-clamp-2">
                                        {{ app()->getLocale() == 'en' ? $related->v_title_en : $related->v_title_id }}
                                    </h3>
                                    <div class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">
                                        <p class="mb-3"><span class="font-medium">{{ __('general.closing_date') }}</span> {{ $related->closed_date_formatted }}</p>
                                        
                                        <div class="flex flex-col space-y-2">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                                </svg>
                                                <span>{{ app()->getLocale() == 'en' ? $related->department_name_en : $related->department_name_id }}</span>
                                            </div>
                                            
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                <span>{{ app()->getLocale() == 'en' ? $related->employment_name_en : $related->employment_name_id }}</span>
                                            </div>
                                        
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <path d="M12 16v-4"></path>
                                                    <path d="M12 8h.01"></path>
                                                </svg>
                                                <span>Min. {{ app()->getLocale() == 'en' ? $related->experience_name_en : $related->experience_name_id }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route(app()->getLocale() . '.vacancy.show', $related->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">
                                        {{ __('general.see_more') }} →
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/vacancy.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/detail-page.js') }}"></script>
<script src="{{ asset('js/vacancy-detail.js') }}"></script>
@endsection