@extends('master')

@section('title', __('general.recipes') . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/recipe.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

<!-- Recipe Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">
                {{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}
            </h1>
        </div>
        <div class="w-full max-w-2xl">
            <img src="{{ $header->h_image }}" alt="Recipe-Header" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Recipe Section -->
<section class="py-12 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased recipe-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <div class="filter-buttons mb-8">
            <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }} active" data-filter="all">{{ __('general.all_categories') }}</button>
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }}" data-filter="{{ $category->rc_title_id }}">
                        {{ app()->getLocale() == 'en' ? $category->rc_title_en : $category->rc_title_id }}
                    </button>
                @endforeach
            @else
                <p class="{{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">{{ __('general.no_categories') }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(count($recipes) > 0)
                @foreach($recipes as $recipe)
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
                <div class="col-span-full text-center py-10">
                    <p class="text-lg {{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">{{ __('general.no_recipes') }}</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/recipe.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection