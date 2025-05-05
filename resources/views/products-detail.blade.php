@extends('master')

@section('style')
<link href="{{ asset('css/product-detail.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">
                {{ $product->category_name_id }}
            </p>
            <h1 class="text-5xl font-bold dark:text-gray-200">
                {{ $product->p_title_id }}
            </h1>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Product Detail Section -->
<section class="py-12 bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-start lg:space-x-8">
            <!-- Product Image -->
            <div class="lg:w-1/2">
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ $product->p_image }}" alt="{{ $product->p_title_id }}" class="w-full h-auto">
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="mt-10 lg:mt-0 lg:w-1/2">
                <div class="border-b border-gray-200 pb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $product->p_title_id }}</h1>
                    <h2 class="text-sm text-custom-red font-medium mt-1">{{ $product->category_name_id }}</h2>
                </div>
                
                <div class="py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Description</h3>
                    <div class="mt-4 prose prose-sm text-gray-500 dark:text-gray-400">
                        <p>{{ $product->p_description_id }}</p>
                    </div>
                </div>

                @if(isset($product->detail))
                <div class="py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Details</h3>
                    <div class="mt-4 prose prose-sm text-gray-500 dark:text-gray-400">
                        {!! $product->detail->pd_longdesc_id !!}
                    </div>
                </div>

                <div class="py-6 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">History</h3>
                    <div class="mt-4 prose prose-sm text-gray-500 dark:text-gray-400">
                        {!! $product->detail->pd_history_id !!}
                    </div>
                </div>
                
                <!-- E-commerce Links -->
                <div class="py-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Shop Now</h3>
                    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
                        @if(!empty($product->detail->pd_link_shopee))
                        <a href="{{ $product->detail->pd_link_shopee }}" target="_blank" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-500 hover:bg-orange-600">
                            Shopee
                        </a>
                        @endif
                        
                        @if(!empty($product->detail->pd_link_tokopedia))
                        <a href="{{ $product->detail->pd_link_tokopedia }}" target="_blank" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600">
                            Tokopedia
                        </a>
                        @endif
                        
                        @if(!empty($product->detail->pd_link_blibli))
                        <a href="{{ $product->detail->pd_link_blibli }}" target="_blank" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600">
                            Blibli
                        </a>
                        @endif
                        
                        @if(!empty($product->detail->pd_link_lazada))
                        <a href="{{ $product->detail->pd_link_lazada }}" target="_blank" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-500 hover:bg-purple-600">
                            Lazada
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection