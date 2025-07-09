@extends('master')

@section('title', __('general.products') . ' - Pazar Seasonings')

@section('style')
<!-- Include product and card height styles for consistent layout -->
<link href="{{ asset('css/product.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('header')
<!-- Header Section: Displays the product page banner with title and image -->
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <!-- Dynamic page title based on locale -->
            <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">
                {{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}
            </h1>
        </div>
        <div class="w-full max-w-2xl">
            <!-- Header image for the product page -->
            <img src="{{ $header->h_image }}" alt="Product-Header" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Product List Section: Shows filter buttons and product cards -->
<section class="py-12 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased product-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <div class="filter-container">
            <!-- Download catalog button -->
            <a href="{{ route(app()->getLocale() . '.products.download-catalog') }}" class="download-catalog-btn inline-block bg-custom-lightergreen hover:bg-custom-green text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                {{ app()->getLocale() == 'en' ? 'Download Catalog' : 'Unduh Katalog' }}
            </a>
            
            <!-- Search Bar -->
            <div class="search-container mb-6">
                <div class="relative max-w-md mx-auto">
                    <input 
                        type="text" 
                        id="productSearch" 
                        placeholder="{{ app()->getLocale() == 'en' ? 'Search products...' : 'Cari produk...' }}"
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
            
            <div class="filter-buttons">
                <!-- Filter button for all categories -->
                <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }} active" data-filter="all">{{ __('general.all_categories') }}</button>
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <!-- Filter button for each product category -->
                        <button class="filter-btn {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }}" data-filter="{{ $category->pc_title_id }}">
                            {{ app()->getLocale() == 'en' ? $category->pc_title_en : $category->pc_title_id }}
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
                {{ app()->getLocale() == 'en' ? 'No products found matching your search.' : 'Tidak ada produk yang ditemukan sesuai pencarian Anda.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8" id="productsGrid">
            @if(count($products) > 0)
                @foreach($products as $product)
                    <!-- Product card for each product -->
                    <div class="product-item {{ $theme === 'dark' ? 'bg-gray-400' : 'bg-gray-200' }} rounded-lg shadow-sm flex flex-col border border-gray-100 overflow-hidden max-w-xs mx-auto w-full" 
                        data-id="{{ $product->p_id }}" 
                        data-category="{{ $product->category_name_id }}"
                        data-title-id="{{ strtolower($product->p_title_id) }}"
                        data-title-en="{{ strtolower($product->p_title_en) }}"
                        data-description-id="{{ strtolower($product->p_description_id) }}"
                        data-description-en="{{ strtolower($product->p_description_en) }}">
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
                            <a href="{{ route(app()->getLocale() . '.product.show', $product->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">{{ __('general.see_more') }} →</a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Message if no products are available -->
                <div class="col-span-full text-center py-10">
                    <p class="text-lg {{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }}">{{ __('general.no_products') }}</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('script')
<!-- Include scripts for product page interactivity and filtering -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/product.js') }}"></script>
<script src="{{ asset('js/product-search.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection