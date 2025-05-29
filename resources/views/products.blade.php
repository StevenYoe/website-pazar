@extends('master')

@section('title', __('general.products') . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/product.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

<!-- Product Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">
                {{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}
            </h1>
        </div>
        <div class="w-full max-w-2xl">
            <img src="{{ $header->h_image }}" alt="Product-Header" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Product Section -->
<section class="py-12 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased product-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <!-- Filter Buttons Section with Download Catalog -->
        <div class="relative mb-8">
            <!-- Filter Buttons (tetap di posisi normal) -->
            <div class="filter-buttons">
                <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }} active" data-filter="all">{{ __('general.all_categories') }}</button>
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }}" data-filter="{{ $category->pc_title_id }}">
                            {{ app()->getLocale() == 'en' ? $category->pc_title_en : $category->pc_title_id }}
                        </button>
                    @endforeach
                @else
                    <p class="{{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">{{ __('general.no_categories') }}</p>
                @endif
            </div>

            <!-- Download Catalog Button (positioned absolute di kanan) -->
            <div class="absolute top-6 -right-12 download-catalog-section">
                <a href="{{ route('products.download-catalog') }}"
                    class="download-catalog-btn inline-flex items-center px-6 py-3 bg-custom-lightergreen hover:bg-custom-green text-white font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ app()->getLocale() == 'en' ? 'Download Catalog' : 'Unduh Katalog' }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @if(count($products) > 0)
                @foreach($products as $product)
                    <div class="product-item {{ $theme === 'dark' ? 'bg-gray-400' : 'bg-gray-200' }} rounded-lg shadow-sm flex flex-col border border-gray-100 overflow-hidden max-w-xs mx-auto w-full" 
                        data-id="{{ $product->p_id }}" 
                        data-category="{{ $product->category_name_id }}">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $product->p_image }}" alt="{{ $product->p_title_id }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex flex-col">
                            <h3 class="text-xl text-black font-bold mb-1 line-clamp-2">
                                {{ app()->getLocale() == 'en' ? $product->p_title_en : $product->p_title_id }}
                            </h3>
                            <h5 class="text-sm text-custom-red font-bold mb-2">
                                {{ app()->getLocale() == 'en' ? $product->category_name_en : $product->category_name_id }}
                            </h5>
                            <p class="text-gray-800 mb-4 flex-grow line-clamp-3">
                                {{ app()->getLocale() == 'en' ? $product->p_description_en : $product->p_description_id }}
                            </p>
                            <a href="{{ url('product/' . $product->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">{{ __('general.see_more') }} →</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-10">
                    <p class="text-lg {{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">{{ __('general.no_products') }}</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/product.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection