<!--
    brand.blade.php
    
    This Blade template renders the Brand page, including:
    - The header section with a dynamic title and image
    - The "Why Pazar" section with key selling points
    - The Certification carousel with navigation and indicators
    - The Testimonials section with tab switching for Customer and Chef testimonials
    - All sections are responsive and theme-aware (dark/light)
    - JavaScript is included for interactivity (carousel, tabs, card height, etc.)
    
    Comments are provided throughout to help programmers understand the structure and logic.
-->
@extends('master')

@section('title', __('general.brand') . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/brand.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('header')
<!-- Header section: displays the main title and header image for the brand page -->
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400">{{ __('general.about') }}</p>
            <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">
                {{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}
            </h1>
        </div>
        @if(isset($header->h_image))
        <div class="w-full max-w-2xl">
            <img src="{{ $header->h_image }}" alt="Brand-Header" class="rounded-lg shadow-lg w-full">
        </div>
        @endif
    </div>
</div>
@endsection

@section('content')
<!-- Why Pazar section: highlights key reasons to choose Pazar (max 5 per row, centered) -->
<section class="why-pazar py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ __('general.why_pazar') }}</h2>
        
        @if(isset($whyPazarItems) && count($whyPazarItems) > 0)
            <div class="flex flex-wrap justify-center gap-6">
                @foreach($whyPazarItems as $item)
                    {{-- Each card with consistent width and flexible layout --}}
                    <div class="flex-none w-full sm:w-[calc(50%-12px)] lg:w-[calc(20%-19.2px)] max-w-xs {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6 flex flex-col">
                        <div class="flex items-start mb-2">
                            <div class="flex-shrink-0 mr-2">
                                <img src="{{ $item->w_image }}" alt="{{ $item->w_title_id }}" class="w-10 h-10">
                            </div>
                            <h3 class="text-lg font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }} line-clamp-3">
                                {{ app()->getLocale() == 'en' ? $item->w_title_en : $item->w_title_id }}
                            </h3>
                        </div>
                        <p class="{{ $theme === 'dark' ? 'text-gray-400' : 'text-gray-900' }} {{ app()->getLocale() == 'en' ? 'mb-6' : '' }} text-sm mt-2 flex-grow line-clamp-4">
                            {{ app()->getLocale() == 'en' ? $item->w_description_en : $item->w_description_id }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Certification carousel: displays certifications with carousel navigation and indicators -->
<section class="certification py-16 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ __('general.certifications') }}</h2>
        
        <div class="relative">
            <div class="carousel-container overflow-hidden">
                <div class="carousel-track flex transition-transform duration-500" id="certificationTrack">
                    @if(isset($certifications) && count($certifications) > 0)
                        @foreach($certifications as $certification)
                            <!-- Each certification card -->
                            <div class="certification-item min-w-full md:min-w-[50%] px-4">
                                <div class="{{ $theme === 'dark' ? 'bg-gray-300' : 'bg-white' }} rounded-lg shadow-sm p-6 flex flex-row items-center h-full">
                                    <div class="w-full md:w-1/3 mb-6 md:mb-0">
                                        <img src="{{ $certification->c_image ?? 'img/Certification/default-certification.jpg' }}" alt="{{ $certification->c_title_id }}" class="rounded-lg mx-auto max-h-48">
                                    </div>
                                    <div class="w-full md:w-2/3 md:pl-6">
                                        <div class="mb-4">
                                            <span class="bg-custom-lightergreen px-3 py-1 rounded-full text-sm font-medium {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ $certification->c_label_id }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold mb-2">
                                            {{ app()->getLocale() == 'en' ? $certification->c_title_en : $certification->c_title_id }}
                                        </h3>
                                        <p class="{{ $theme === 'dark' ? 'text-gray-900' : 'text-gray-800' }} mb-4">
                                            {{ app()->getLocale() == 'en' ? $certification->c_description_en : $certification->c_description_id }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
            <!-- Carousel navigation buttons -->
            <button class="carousel-nav carousel-prev absolute top-1/2 left-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10 hidden md:block" aria-label="Previous slide">
                <img src="{{ asset('img/web/left.svg') }}" alt="left icon" class="h-6 w-6">
            </button>
            <button class="carousel-nav carousel-next absolute top-1/2 right-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10 hidden md:block" aria-label="Next slide">
                <img src="{{ asset('img/web/right.svg') }}" alt="right icon" class="h-6 w-6">
            </button>
            
            <!-- Carousel indicators (dots) -->
            <div class="carousel-indicators flex justify-center mt-8 space-x-2">
                @if(isset($certifications) && count($certifications) > 0)
                    @foreach($certifications as $index => $certification)
                        <button class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-custom-green' : 'bg-gray-300' }}" data-index="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Testimonials section: tabbed interface for Customer and Chef testimonials -->
<section class="testimonials py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-8 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ __('general.testimonials') }}</h2>
        
        <!-- Tab buttons for switching between Customer and Chef testimonials -->
        <div class="flex justify-center mb-8">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button" id="customerTabBtn" class="testimonial-tab-active {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }} px-5 py-2 text-sm font-medium rounded-l-lg">
                    Customer
                </button>
                <button type="button" id="chefTabBtn" class="testimonial-tab {{ $theme === 'dark' ? 'bg-transparent' : 'bg-custom-lightergreen' }} px-5 py-2 text-sm font-medium rounded-r-lg">
                    Chef
                </button>
            </div>
        </div>
        
        <!-- Customer testimonials tab content (max 3 per row, centered) -->
        <div id="customerTestimonials" class="testimonial-content">
            @if(isset($customerTestimonials) && count($customerTestimonials) > 0)
                <div class="flex flex-wrap justify-center gap-8">
                    @foreach($customerTestimonials as $index => $testimonial)
                        <!-- Each customer testimonial card with consistent width -->
                        <div class="flex-none w-full md:w-[calc(50%-16px)] lg:w-[calc(33.333%-21.33px)] max-w-sm {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6 relative">
                            <div class="flex items-center mb-4">
                                <div class="h-10 w-10 mr-4">
                                    @if($testimonial->t_image)
                                        <img src="{{ $testimonial->t_image }}" alt="{{ $testimonial->t_name }}" class="h-full w-full rounded-full object-cover">
                                    @elseif($testimonial->t_gender == 'Male')
                                        <img src="{{ asset('img/Testimonial/male-avatar.svg') }}" alt="{{ $testimonial->t_name }}" class="h-full w-full rounded-full object-cover">
                                    @elseif($testimonial->t_gender == 'Female')
                                        <img src="{{ asset('img/Testimonial/female-avatar.svg') }}" alt="{{ $testimonial->t_name }}" class="h-full w-full rounded-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <!-- Customer name with optional link -->
                                    @if(!empty($testimonial->t_link))
                                        <a href="{{ $testimonial->t_link }}" target="_blank" class="text-lg font-semibold {{ $theme === 'dark' ? 'text-gray-200 hover:text-custom-lightgreen' : 'text-black hover:text-custom-green' }} transition-colors duration-200">
                                            {{ $testimonial->t_name }}
                                        </a>
                                    @else
                                        <h4 class="text-lg font-semibold {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ $testimonial->t_name }}</h4>
                                    @endif
                                    
                                    <!-- Display product name instead of "Customer" -->
                                    @if(!empty($testimonial->t_product_id) || !empty($testimonial->t_product_en))
                                        <p class="text-sm text-custom-lightgreen">
                                            {{ app()->getLocale() == 'en' ? ($testimonial->t_product_en ?? $testimonial->t_product_id) : ($testimonial->t_product_id ?? $testimonial->t_product_en) }}
                                        </p>
                                    @else
                                        <p class="text-sm text-custom-lightgreen">Customer</p>
                                    @endif
                                </div>
                            </div>
                            <p class="{{ $theme === 'dark' ? 'text-gray-400' : 'text-gray-800' }} mb-4">
                                {!! app()->getLocale() == 'en' ? nl2br(e($testimonial->t_description_en)) : nl2br(e($testimonial->t_description_id)) !!}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Chef testimonials tab content -->
        <div id="chefTestimonials" class="testimonial-content hidden">
            <div class="space-y-8">
                @if(isset($chefTestimonials) && count($chefTestimonials) > 0)
                    @foreach($chefTestimonials as $index => $testimonial)
                        @if($index % 2 == 0)
                        <!-- Chef testimonial card (left image) -->
                        <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6">
                            <div class="flex flex-col md:flex-row items-center">
                                <div class="md:w-3/5 mb-6 md:mb-0">
                                    <img src="{{ $testimonial->t_image ?? asset('img/Testimonial/default-chef.jpg') }}" alt="{{ $testimonial->t_name }}" class="rounded-lg mx-auto w-full object-cover">
                                </div>
                                <div class="md:w-2/5 md:pl-8">
                                    <h4 class="text-xl font-bold mb-4 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ $testimonial->t_name }}</h4>
                                    <p class="{{ $theme === 'dark' ? 'text-gray-400' : 'text-gray-800' }}">
                                        {!! app()->getLocale() == 'en' ? nl2br(e($testimonial->t_description_en)) : nl2br(e($testimonial->t_description_id)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Chef testimonial card (right image) -->
                        <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6">
                            <div class="flex flex-col md:flex-row-reverse items-center">
                                <div class="md:w-3/5 mb-6 md:mb-0">
                                    <img src="{{ $testimonial->t_image ?? asset('img/Testimonial/default-chef.jpg') }}" alt="{{ $testimonial->t_name }}" class="rounded-lg mx-auto w-full object-cover">
                                </div>
                                <div class="md:w-2/5 md:pl-8 md:pr-0">
                                    <h4 class="text-xl font-bold mb-4 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ $testimonial->t_name }}</h4>
                                    <p class="{{ $theme === 'dark' ? 'text-gray-400' : 'text-gray-800' }}">
                                        {!! app()->getLocale() == 'en' ? nl2br(e($testimonial->t_description_en)) : nl2br(e($testimonial->t_description_id)) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<!-- JavaScript includes for interactivity: navigation, carousel, tabs, etc. -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/brand.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
@endsection