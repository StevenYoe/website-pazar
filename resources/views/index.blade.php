@extends('master')

@section('style')
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

<!-- Hero/Header Section -->
@section('header')
<div class="landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="grid md:grid-cols-2 gap-8 items-center">
        <div class="text-white">
            @if(isset($header))
                <h1 class="text-2xl font-bold mb-4 dark:text-gray-200">{{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}</h1>
                <p class="text-lg mb-6 dark:text-gray-200">{{ app()->getLocale() == 'en' ? $header->h_description_en : $header->h_description_id }}</p>
            @endif
            <a href="/company" class="inline-block bg-custom-lightgreen hover:bg-custom-green {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }} font-bold py-3 px-8 rounded-lg transition duration-300">
                {{ __('general.see_more') }}
            </a>
        </div>
        <div>
            @if(isset($header) && $header->h_image)
                <img src="{{ $header->h_image }}" alt="Pazar Products" class="rounded-lg shadow-lg">
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Pop-up Modal -->
@if(isset($popup) && $popup->pu_is_active)
<div id="popupModal" class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="relative bg-transparent rounded-lg shadow-lg max-w-2xl flex flex-col items-center">
        <!-- Container with relative positioning -->
        <div class="relative">
            <!-- Image Link -->
            <a href="{{ $popup->pu_link }}">
                <img src="{{ $popup->pu_image }}" alt="Pop Up Foto" 
                    class="mx-auto rounded-lg transition-opacity duration-300 hover:opacity-75 max-h-[600px] max-w-[80%] w-auto" />
            </a>
            
            <!-- Close Button - Positioned absolutely inside the top right corner of the image -->
            <button id="closeModal" class="absolute top-1 right-[calc(10%+3px)] bg-gray-200 hover:bg-gray-300 rounded-full p-2 flex items-center justify-center">
                <img src="img/Web/close.svg" class="w-5 h-5">
            </button>
        </div>
    </div>
</div>
@endif

<!-- Why Pazar Section -->
<section class="why-pazar py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.why_pazar') }}</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @if(isset($whyPazarItems) && count($whyPazarItems) > 0)
                @foreach($whyPazarItems as $item)
                    <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6 flex flex-col">
                        <div class="flex items-start mb-2">
                            <div class="flex-shrink-0 mr-2">
                                <img src="{{ $item->w_image }}" alt="{{ $item->w_title_id }}" class="w-10 h-10">
                            </div>
                            <h3 class="text-lg font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }} line-clamp-2">
                                {{ app()->getLocale() == 'en' ? $item->w_title_en : $item->w_title_id }}
                            </h3>
                        </div>
                        <p class="{{ $theme === 'dark' ? 'text-gray-400' : 'text-gray-900' }} text-sm mt-2 flex-grow line-clamp-4">
                            {{ app()->getLocale() == 'en' ? $item->w_description_en : $item->w_description_id }}
                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Product Category Section -->
<section class="product-category py-10 {{ $theme === 'dark' ? 'bg-gray-950' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.product_category') }}</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4">
            @if(isset($productCategories) && count($productCategories) > 0)
                @foreach($productCategories as $category)
                    <div class="category-item {{ $theme === 'dark' ? 'bg-white' : 'bg-gray-300' }} rounded-lg shadow-sm flex flex-col border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $category->pc_image ?? 'img/Category/default-category.jpg' }}" alt="{{ $category->pc_title_id }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex flex-col">
                            <h3 class="text-xl font-bold mb-2 line-clamp-2">
                                {{ app()->getLocale() == 'en' ? $category->pc_title_en : $category->pc_title_id }}
                            </h3>
                            <p class="{{ $theme === 'dark' ? 'text-gray-800' : 'text-gray-600' }} mb-4 flex-grow line-clamp-3">
                                {{ app()->getLocale() == 'en' ? $category->pc_description_en : $category->pc_description_id }}
                            </p>
                            <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">{{ __('general.see_more') }} →</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Latest Recipe Section -->
@if(isset($latestRecipe))
<section class="latest-recipe py-10 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-white' : 'text-black' }}">{{ __('general.our_recipe') }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 items-center">
            <div>
                <img src="{{ $latestRecipe->r_image }}" alt="{{ $latestRecipe->r_title_id }}" class="rounded-lg shadow-lg w-full h-auto">
            </div>
            <div>
                <h3 class="text-3xl {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }} font-bold mb-4">
                    {{ app()->getLocale() == 'en' ? $latestRecipe->r_title_en : $latestRecipe->r_title_id }}
                </h3>
                <p class="text-sm text-custom-green mb-4">
                    @if(isset($latestRecipe->category_names) && count($latestRecipe->category_names) > 0)
                        {{ implode(', ', $latestRecipe->category_names) }}
                    @elseif(isset($latestRecipe->category_name))
                        {{ $latestRecipe->category_name }}
                    @else
                        {{ app()->getLocale() == 'en' ? $latestRecipe->category_name_en : $latestRecipe->category_name_id }}
                    @endif
                </p>
                <a href="{{ url('recipe/' . $latestRecipe->slug) }}" class="inline-block bg-custom-lightgreen hover:bg-custom-green {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }} font-bold py-3 px-8 rounded-lg transition duration-300">
                    {{ __('general.view_recipe') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection