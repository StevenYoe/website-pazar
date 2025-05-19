@extends('master')

@section('style')
<link href="{{ asset('css/vacancy.css') }}" rel="stylesheet" type="text/css" >
@endsection

<!-- Vacancies Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">Karir</p>
            <h1 class="text-5xl font-bold dark:text-gray-200">
                {{ $header->h_title_id ?? 'Vacancy Positions' }}
            </h1>
        </div>
        @if(isset($header->h_image))
        <div class="w-full max-w-2xl">
            <img src="{{ $header->h_image }}" alt="Vacancies-Header" class="rounded-lg shadow-lg w-full">
        </div>
        @endif
    </div>
</div>
@endsection

@section('content')
<!-- Vacancies Section -->
<section class="py-12 bg-gray-50 dark:bg-gray-950 antialiased dark:text-gray-200 vacancies-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <!-- Filter Section -->
        <div class="filters mb-12 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-200">Filter Vacancies</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Department Filter -->
                <div class="filter-group">
                    <label for="department-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Departemen</label>
                    <select id="department-filter" class="block w-full py-2 px-3 border dark:text-black border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-custom-green focus:border-custom-green">
                        <option value="all">Semua Departemen</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->da_id }}">{{ $department->da_title_id }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Employment Type Filter -->
                <div class="filter-group">
                    <label for="employment-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Model Kerja</label>
                    <select id="employment-filter" class="block w-full py-2 px-3 border dark:text-black border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-custom-green focus:border-custom-green">
                        <option value="all">Semua Model Kerja</option>
                        @foreach($employments as $employment)
                            <option value="{{ $employment->e_id }}">{{ $employment->e_title_id }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Experience Level Filter -->
                <div class="filter-group">
                    <label for="experience-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pengalaman</label>
                    <select id="experience-filter" class="block w-full py-2 px-3 border dark:text-black border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-custom-green focus:border-custom-green">
                        <option value="all">Semua Pengalaman</option>
                        @foreach($experiences as $experience)
                            <option value="{{ $experience->ex_id }}">{{ $experience->ex_title_id }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Vacancies Listing -->
        <div id="vacancies-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(count($vacancies) > 0)
                @foreach($vacancies as $vacancy)
                    <div class="vacancy-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden"
                        data-department="{{ $vacancy->v_department_id }}"
                        data-employment="{{ $vacancy->v_employment_id }}"
                        data-experience="{{ $vacancy->v_experience_id }}">
                        
                        @if(isset($vacancy->v_urgent) && $vacancy->v_urgent)
                        <div class="urgent-tag">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 23a7.5 7.5 0 01-5.138-12.963C8.204 8.774 11.5 6.5 11 1.5c6 4 9 8 3 14 1 0 2.5 0 5-2.47.27.773.5 1.604.5 2.47A7.5 7.5 0 0112 23z"></path>
                                </svg>
                                Urgently needed
                            </span>
                        </div>
                        @endif
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl text-black font-bold mb-3">{{ $vacancy->v_title_id }}</h3>
                            <div class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">
                                <p class="mb-3"><span class="font-medium">Pendaftaran Ditutup:</span> {{ $vacancy->closed_date_formatted }}</p>
                                
                                <div class="flex flex-col space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg>
                                        <span>{{ $vacancy->department_name_id }}</span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span>{{ $vacancy->employment_name_id }}</span>
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-custom-green" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 16v-4"></path>
                                            <path d="M12 8h.01"></path>
                                        </svg>
                                        <span>Min. {{ $vacancy->experience_name_id }}</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ url('vacancy/' . $vacancy->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-10">
                    <p class="text-lg text-gray-500">No vacancies found</p>
                </div>
            @endif
        </div>
        
        <!-- No Results Message - Removed "hidden" class to make it appear when needed -->
        <div id="no-results" class="hidden text-center py-10 col-span-full">
            <p class="text-lg text-gray-500">No vacancies match your filter criteria</p>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/vacancy.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection