@extends('master')

@section('title', (app()->getLocale() == 'en' ? $product->p_title_en : $product->p_title_id) . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/product-detail.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/product.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('header')
<!-- Override with empty header to remove default landing content on product detail page -->
<div class="product-detail-header"></div>
@endsection

@section('content')
<!-- Product Detail Section: Displays product image, info, and description -->
<section class="pt-10 pb-12 {{ $theme === 'dark' ? 'bg-gray-900 text-gray-400' : 'bg-white text-gray-900' }}">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb Navigation: Shows navigation path for user orientation -->
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
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ url('/products') }}" class="ml-1 text-sm font-medium {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' }} hover:text-custom-green">{{ __('general.products') }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium {{ $theme === 'dark' ? 'text-gray-500' : 'text-black' }} md:ml-2">{!! app()->getLocale() == 'en' ? $product->p_title_en : $product->p_title_id !!}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="lg:flex lg:items-start lg:space-x-8">
            <!-- Product Image Section -->
            <div class="lg:w-1/2">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ $product->p_image }}" alt="{{ $product->p_title_id }}" class="w-full h-auto">
                </div>
            </div>
            
            <!-- Product Info Section: Title, category, and description -->
            <div class="mt-10 lg:mt-0 lg:w-1/2">
                <div class="pb-3">
                    <h1 class="text-3xl {{ $theme === 'dark' ? 'text-white' : 'text-gray-900' }}">{!! app()->getLocale() == 'en' ? $product->p_title_en : $product->p_title_id !!}</h1>
                    <h2 class="mt-2 prose prose-sm text-custom-red">{!! app()->getLocale() == 'en' ? $product->category_name_en : $product->category_name_id !!}</h2>
                </div>
                @if(isset($product->detail))
                    <div class="py-1">
                        <div class="mt-2 prose prose-sm {{ $theme === 'dark' ? 'text-gray-200' : 'text-gray-500' }}">
                            @if(!empty($product->detail->pd_net_weight))    
                                <!-- Net weight info -->
                                <p class="mb-2 {{ $theme === 'dark' ? 'text-gray-400' : 'text-gray-700' }}"> {{ __('general.net_weight') . ': ' . $product->detail->pd_net_weight }}</p>
                            @endif
                            <!-- Short product description -->
                            <p class="mb-4"> {!! app()->getLocale() == 'en' ? $product->p_description_en : $product->p_description_id !!}</p>
                            @if(!empty($product->detail->pd_longdesc_id))
                                <!-- Long product description -->
                                {!! app()->getLocale() == 'en' ? nl2br(e($product->detail->pd_longdesc_en)) : nl2br(e($product->detail->pd_longdesc_id)) !!}
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- E-commerce Links with store logos: Direct links to buy the product on various platforms -->
        @if(isset($product->detail))
        <div class="mt-10 pt-6">
            <h3 class="text-xl font-medium {{ $theme === 'dark' ? 'text-white' : 'text-gray-900' }} text-center mb-6">{{ __('general.buy_now') }}</h3>
            <div class="flex justify-center items-center">
                <div class="flex flex-wrap justify-center gap-4 max-w-2xl">
                    @if(!empty($product->detail->pd_link_shopee))
                    <div class="w-32 sm:w-36">
                        <a href="{{ $product->detail->pd_link_shopee }}" target="_blank">
                            <img src="{{ config('app.storage_url') }}/webs/Shopee.png" alt="Shopee" class="w-full transition-opacity hover:opacity-80">
                        </a>
                    </div>
                    @endif
                    
                    @if(!empty($product->detail->pd_link_tokopedia))
                    <div class="w-32 sm:w-36">
                        <a href="{{ $product->detail->pd_link_tokopedia }}" target="_blank">
                            <img src="{{ config('app.storage_url') }}/webs/Tokopedia.png" alt="Tokopedia" class="w-full transition-opacity hover:opacity-80">
                        </a>
                    </div>
                    @endif
                    
                    @if(!empty($product->detail->pd_link_blibli))
                    <div class="w-32 sm:w-36">
                        <a href="{{ $product->detail->pd_link_blibli }}" target="_blank">
                            <img src="{{ config('app.storage_url') }}/webs/Blibli.png" alt="Blibli" class="w-full transition-opacity hover:opacity-80">
                        </a>
                    </div>
                    @endif
                    
                    @if(!empty($product->detail->pd_link_lazada))
                    <div class="w-32 sm:w-36">
                        <a href="{{ $product->detail->pd_link_lazada }}" target="_blank">
                            <img src="{{ config('app.storage_url') }}/webs/Lazada.png" alt="Lazada" class="w-full transition-opacity hover:opacity-80">
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
        
        <!-- Related Products Section: Shows other products for cross-selling -->
        @if(count($randomProducts) > 0)
        <div class="mt-16 product-section">
            <h2 class="text-2xl font-bold text-center {{ $theme === 'dark' ? 'text-white' : 'text-gray-900' }} mb-8">{{ __('general.related_products') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($randomProducts as $randomProduct)
                <div class="product-item {{ $theme === 'dark' ? 'bg-gray-400' : 'bg-gray-200' }} rounded-lg shadow-sm flex flex-col border border-gray-200 overflow-hidden max-w-xs mx-auto w-full"
                    data-id="{{ $randomProduct->p_id }}" 
                    data-category="{{ $randomProduct->category_name_id }}">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $randomProduct->p_image }}" alt="{{ $randomProduct->p_title_id }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <a href="{{ route(app()->getLocale() . '.product.show', $randomProduct->slug) }}" class="hover:text-custom-red">
                            <h3 class="text-xl text-black font-bold mb-1 hover:text-custom-red line-clamp-2">
                                {{ app()->getLocale() == 'en' ? $randomProduct->p_title_en : $randomProduct->p_title_id }}
                            </h3>
                        </a>
                        <h5 class="text-sm text-custom-red font-bold mb-2">
                            {!! app()->getLocale() == 'en' ? $randomProduct->category_name_en : $randomProduct->category_name_id !!}
                        </h5>
                        <p class="text-gray-800 flex-grow line-clamp-3">
                            {!! app()->getLocale() == 'en' ? $randomProduct->p_description_en : $randomProduct->p_description_id !!}
                        </p>
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
<!-- Include scripts for product detail interactivity and UI behavior -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
<script src="{{ asset('js/detail-page.js') }}"></script>
@endsection