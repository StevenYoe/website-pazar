@extends('master')

@section('title', $recipe->r_title_id . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/recipe-detail.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/recipe.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('header')
<!-- Override with empty header to remove default landing content -->
<div class="recipe-detail-header"></div>
@endsection

@section('content')
<!-- Recipe Detail Section -->
<section class="pt-10 pb-12 bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-custom-green dark:text-gray-300 dark:hover:text-custom-green">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ url('/recipes') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-custom-green md:ml-2 dark:text-gray-300 dark:hover:text-custom-green">Recipes</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $recipe->r_title_id }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="lg:flex lg:items-start lg:space-x-8">
            <!-- Recipe Image -->
            <div class="lg:w-1/2">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ $recipe->r_image }}" alt="{{ $recipe->r_title_id }}" class="w-full h-auto">
                </div>
                
                <!-- YouTube Video Embed (if available) -->
                @if(isset($recipe->detail) && isset($recipe->detail->rd_link_youtube) && !empty($recipe->detail->rd_link_youtube))
                <div class="mt-10">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-lg">
                        <iframe 
                            src="{{ str_replace('watch?v=', 'embed/', $recipe->detail->rd_link_youtube) }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                            class="w-full h-full"
                        ></iframe>
                    </div>
                    <a href="{{ $recipe->detail->rd_link_youtube }}" target="_blank" class="inline-flex items-center mt-5 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 4-8 4z"/>
                        </svg>
                        Tonton Video di YouTube
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Recipe Info -->
            <div class="mt-10 lg:mt-0 lg:w-1/2">
                <div class="pb-2">
                    <h1 class="text-3xl text-gray-900 dark:text-white">{{ $recipe->r_title_id }}</h1>
                    <h2 class="mt-2 prose prose-sm text-custom-red">
                        @if(isset($recipe->category_names) && count($recipe->category_names) > 0)
                            {{ implode(', ', $recipe->category_names) }}
                        @else
                            {{ $recipe->category_name_id }}
                        @endif
                    </h2>
                </div>
                    @if(isset($recipe->detail))
                    <div class="py-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Deskripsi</h3>
                        <div class="mt-4 prose prose-sm text-gray-500 dark:text-gray-400">
                            {!! nl2br(e($recipe->detail->rd_desc_id)) !!}
                        </div>
                    </div>
                    @if(isset($recipe->detail->rd_ingredients_id) && !empty($recipe->detail->rd_ingredients_id))
                    <div class="py-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Bahan-bahan</h3>
                        <div class="mt-4 prose prose-sm text-gray-500 dark:text-gray-400">
                            {!! nl2br(e($recipe->detail->rd_ingredients_id)) !!}
                        </div>
                    </div>
                    @endif
                        
                    @if(isset($recipe->detail->rd_cook_id) && !empty($recipe->detail->rd_cook_id))
                    <div class="py-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Cara Pembuatan</h3>
                        <div class="mt-4 prose prose-sm text-gray-500 dark:text-gray-400">
                            {!! nl2br(e($recipe->detail->rd_cook_id)) !!}
                        </div>
                    </div>
                    @endif
                    @else
                    <p class="text-gray-500">Detail resep tidak tersedia</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Other Recipes -->
        @if(count($randomRecipes) > 0)
        <div class="mt-16 recipe-section">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">Resep Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($randomRecipes as $randomRecipe)
                <div class="recipe-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full overflow-hidden max-w-xs mx-auto w-full" 
                    data-id="{{ $randomRecipe->r_id }}" 
                    data-category="{{ $randomRecipe->category_name_id }}"
                    data-categories="{{ json_encode($randomRecipe->category_names ?? [$randomRecipe->category_name_id]) }}">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $randomRecipe->r_image }}" alt="{{ $randomRecipe->r_title_id }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <a href="{{ url('recipe/' . $randomRecipe->slug) }}" class="hover:text-custom-red">
                            <h3 class="text-xl text-black font-bold mb-1 hover:text-custom-red line-clamp-2">{{ $randomRecipe->r_title_id }}</h3>
                        </a>
                        <h4 class="text-sm text-custom-red font-bold mb-2 line-clamp-2">
                            @if(isset($randomRecipe->category_names) && count($randomRecipe->category_names) > 0)
                                {{ implode(', ', $randomRecipe->category_names) }}
                            @else
                                {{ $randomRecipe->category_name_id }}
                            @endif
                        </h4>
                        <a href="{{ url('recipe/' . $randomRecipe->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end mt-auto">SELENGKAPNYA →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
<script src="{{ asset('js/detail-page.js') }}"></script>
@endsection