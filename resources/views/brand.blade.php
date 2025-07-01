@extends('master')

@section('title', __('general.brand') . ' - Pazar Seasonings')

@section('style')
<link href="{{ asset('css/brand.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/card-height.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('header')
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
            <img src="{{ $header->h_image }}" alt="Vacancies-Header" class="rounded-lg shadow-lg w-full">
        </div>
        @endif
    </div>
</div>
@endsection

@section('content')
<section class="why-pazar py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ __('general.why_pazar') }}</h2>
        
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

<section class="certification py-16 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ __('general.certifications') }}</h2>
        
        <div class="relative">
            <div class="carousel-container overflow-hidden">
                <div class="carousel-track flex transition-transform duration-500" id="certificationTrack">
                    @if(isset($certifications) && count($certifications) > 0)
                        @foreach($certifications as $certification)
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
            
            <button class="carousel-nav carousel-prev absolute top-1/2 left-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10 hidden md:block" aria-label="Previous slide">
                <img src="img/Web/left.svg" alt="left icon" class="h-6 w-6">
            </button>
            <button class="carousel-nav carousel-next absolute top-1/2 right-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10 hidden md:block" aria-label="Next slide">
                <img src="img/Web/right.svg" alt="right icon" class="h-6 w-6">
            </button>
            
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

<section class="testimonials py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-8 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ __('general.testimonials') }}</h2>
        
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
        
        <div id="customerTestimonials" class="testimonial-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($customerTestimonials) && count($customerTestimonials) > 0)
                    @foreach($customerTestimonials as $index => $testimonial)
                        <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6 relative">
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
                                    <h4 class="text-lg font-semibold {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ $testimonial->t_name }}</h4>
                                    <p class="text-sm {{ $theme === 'dark' ? 'text-gray-400' : 'text-black' }}">Customer</p>
                                </div>
                            </div>
                            <p class="{{ $theme === 'dark' ? 'text-gray-900' : 'text-gray-800' }} mb-4">
                                {{ app()->getLocale() == 'en' ? $testimonial->t_description_en : $testimonial->t_description_id }}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
        <div id="chefTestimonials" class="testimonial-content hidden">
            <div class="space-y-8">
                @if(isset($chefTestimonials) && count($chefTestimonials) > 0)
                    @foreach($chefTestimonials as $index => $testimonial)
                        @if($index % 2 == 0)
                        <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6">
                            <div class="flex flex-col md:flex-row items-center">
                                <div class="md:w-1/3 mb-6 md:mb-0">
                                    <img src="{{ $testimonial->t_image ?? asset('img/Testimonial/default-chef.jpg') }}" alt="{{ $testimonial->t_name }}" class="rounded-lg mx-auto w-full max-w-xs object-cover">
                                </div>
                                <div class="md:w-2/3 md:pl-8">
                                    <h4 class="text-xl font-bold mb-4 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ $testimonial->t_name }}</h4>
                                    <p class="{{ $theme === 'dark' ? 'text-gray-900' : 'text-gray-800' }}">
                                        {{ app()->getLocale() == 'en' ? $testimonial->t_description_en : $testimonial->t_description_id }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-sm p-6">
                            <div class="flex flex-col md:flex-row-reverse items-center">
                                <div class="md:w-1/3 mb-6 md:mb-0">
                                    <img src="{{ $testimonial->t_image ?? asset('img/Testimonial/default-chef.jpg') }}" alt="{{ $testimonial->t_name }}" class="rounded-lg mx-auto w-full max-w-xs object-cover">
                                </div>
                                <div class="md:w-2/3 md:pl-8 md:pr-0">
                                    <h4 class="text-xl font-bold mb-4 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">{{ $testimonial->t_name }}</h4>
                                    <p class="{{ $theme === 'dark' ? 'text-gray-900' : 'text-gray-800' }}">
                                        {{ app()->getLocale() == 'en' ? $testimonial->t_description_en : $testimonial->t_description_id }}
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

<div id="imagePopupModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImagePopup()" 
                class="absolute -top-4 -right-4 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-full p-2 shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 z-10">
            <svg class="w-6 h-6 {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <div class="{{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} rounded-lg shadow-2xl overflow-hidden">
            <img id="popupImage" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
            <div class="p-4 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }}">
                <p id="popupImageCaption" class="text-center {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-700' }} font-medium"></p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/card-height.js') }}"></script>
<script src="{{ asset('js/brand.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
@endsection