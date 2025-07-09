@extends('master')

@section('title', __('general.recipes') . ' - Pazar Seasonings')

@section('style')
<!-- Include recipe and card height styles for consistent layout -->
<link href="{{ asset('css/recipe.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

<!-- Recipe Header Section: Displays the recipe page banner with title and image -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <!-- Dynamic page title based on locale -->
            <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">
                {{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}
            </h1>
        </div>
        <div class="w-full max-w-2xl">
            <!-- Header image for the recipe page -->
            <img src="{{ $header->h_image }}" alt="Recipe-Header" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Recipe Section: Shows filter buttons and recipe cards -->
<section class="py-12 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased recipe-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <div class="filter-container">
            <!-- Search Bar -->
            <div class="search-container mb-6">
                <div class="relative max-w-md mx-auto">
                    <input 
                        type="text" 
                        id="recipeSearch" 
                        placeholder="{{ app()->getLocale() == 'en' ? 'Search recipes...' : 'Cari resep...' }}"
                        class="w-full px-4 py-3 pl-12 pr-4 bg-white border-gray-300 text-black border rounded-lg focus:outline-none focus:ring-2 focus:ring-custom-green focus:border-transparent"
                    >
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <!-- Clear search button -->
                    <button 
                        type="button" 
                        id="clearSearch" 
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 hidden"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="filter-buttons mb-8">
                <!-- Filter button for all categories -->
                <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }} active" data-filter="all">{{ __('general.all_categories') }}</button>
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <!-- Filter button for each recipe category -->
                        <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }}" data-filter="{{ $category->rc_title_id }}">
                            {{ app()->getLocale() == 'en' ? $category->rc_title_en : $category->rc_title_id }}
                        </button>
                    @endforeach
                @else
                    <p class="{{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">{{ __('general.no_categories') }}</p>
                @endif
            </div>
        </div>

        <!-- No results message -->
        <div id="noResults" class="text-center py-10 hidden">
            <p class="text-lg {{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">
                {{ app()->getLocale() == 'en' ? 'No recipes found matching your search.' : 'Tidak ada resep yang ditemukan sesuai pencarian Anda.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(count($recipes) > 0)
                @foreach($recipes as $recipe)
                    <!-- Recipe card for each recipe -->
                    <div class="recipe-item {{ $theme === 'dark' ? 'bg-gray-400' : 'bg-gray-200' }} rounded-lg shadow-sm flex flex-col border border-gray-100 overflow-hidden max-w-xs mx-auto w-full" 
                        data-id="{{ $recipe->r_id }}" 
                        data-category="{{ $recipe->category_name_id }}"
                        data-categories="{{ json_encode($recipe->category_names ?? [$recipe->category_name_id]) }}">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $recipe->r_image }}" alt="{{ $recipe->r_title_id }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex flex-col">
                            <h3 class="text-xl text-black font-bold mb-1 line-clamp-2">
                                {{ app()->getLocale() == 'en' ? $recipe->r_title_en : $recipe->r_title_id }}
                            </h3>
                            <h4 class="text-sm text-custom-red font-bold mb-4 line-clamp-2">
                                @if(isset($recipe->category_names) && count($recipe->category_names) > 0)
                                    {{ implode(', ', $recipe->category_names) }}
                                @else
                                    {{ app()->getLocale() == 'en' ? $recipe->category_name_en : $recipe->category_name_id }}
                                @endif
                            </h4>
                            <a href="{{ route(app()->getLocale() . '.recipe.show', $recipe->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">
                                {{ __('general.see_more') }} →
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Message if no recipes are available -->
                <div class="col-span-full text-center py-10">
                    <p class="text-lg {{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">{{ __('general.no_recipes') }}</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('script')
<!-- Include scripts for recipe page interactivity and filtering -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/recipe.js') }}"></script>
<script src="{{ asset('js/recipe-search.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection