@extends('master')

@section('title', 'Resep - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/recipe.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

<!-- Recipe Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">
                {{ $header->h_description_id }}
            </p>
            <h1 class="text-5xl font-bold dark:text-gray-200">
                {{ $header->h_title_id }}
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
<section class="py-12 bg-gray-100 dark:bg-gray-950 antialiased dark:text-gray-200 recipe-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <div class="filter-buttons mb-8">
            <button class="filter-btn bg-custom-lightergreen dark:bg-transparent active" data-filter="all">Semua</button>
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <button class="filter-btn bg-custom-lightergreen dark:bg-transparent" data-filter="{{ $category->rc_title_id }}">{{ $category->rc_title_id }}</button>
                @endforeach
            @else
                <p class="text-gray-500">No categories found</p>
            @endif
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(count($recipes) > 0)
                @foreach($recipes as $recipe)
                    <div class="recipe-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col border border-gray-200 overflow-hidden max-w-xs mx-auto w-full" 
                        data-id="{{ $recipe->r_id }}" 
                        data-category="{{ $recipe->category_name_id }}"
                        data-categories="{{ json_encode($recipe->category_names ?? [$recipe->category_name_id]) }}">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $recipe->r_image }}" alt="{{ $recipe->r_title_id }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex flex-col">
                            <h3 class="text-xl text-black font-bold mb-1 line-clamp-2">{{ $recipe->r_title_id }}</h3>
                            <h4 class="text-sm text-custom-red font-bold mb-4 line-clamp-2">
                                @if(isset($recipe->category_names) && count($recipe->category_names) > 0)
                                    {{ implode(', ', $recipe->category_names) }}
                                @else
                                    {{ $recipe->category_name_id }}
                                @endif
                            </h4>
                            <a href="{{ url('recipe/' . $recipe->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-10">
                    <p class="text-lg text-gray-500">No recipes found</p>
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