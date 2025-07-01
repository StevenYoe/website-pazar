@extends('master')

@section('title', __('general.products') . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/product.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

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
<section class="py-12 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased product-section">
    <div class="max-w-screen-xl mx-auto px-4 md:px-20">
        <div class="filter-container">
            <a href="#" class="download-catalog-btn inline-block bg-custom-lightergreen hover:bg-custom-green text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                {{ app()->getLocale() == 'en' ? 'Download Catalog' : 'Unduh Katalog' }}
            </a>
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
                            <a href="{{ route(app()->getLocale() . '.product.show', $product->slug) }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">{{ __('general.see_more') }} →</a>
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