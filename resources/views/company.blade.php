@extends('master')

@section('title', __('general.company') . ' - Pazar Seasonings')

<!-- Company Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            @if(isset($header))
                <p class="text-xl mb-2 text-yellow-400">{{ $header->h_description_id }}</p>
                <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">{{ $header->h_title_id }}</h1>
            @endif
        </div>
        <div class="w-full max-w-4xl">
            @if(isset($header) && $header->h_image)
                <img src="{{ $header->h_image }}" alt="Company-Overview" class="rounded-lg shadow-lg w-full">
            @else
                <img src="img/Web/company.jpg" alt="Company-Overview" class="rounded-lg shadow-lg w-full">
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Company What Section -->
@if(isset($companyWhat))
<section class="company-what py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">Sekilas Perusahaan</h2>
        
        <div class="prose prose-lg mx-auto {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">
            {!! nl2br(e($companyWhat->cp_description_id)) !!}
        </div>
    </div>
</section>
@endif

<!-- History Section -->
<section class="history-section py-16 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">Sejarah Pazar Seasoning</h2>
        
        <div class="relative">
            <!-- History Carousel container -->
            <div class="history-carousel-container overflow-hidden">
                <div class="history-track flex transition-transform duration-500" id="historyTrack">
                    @if(isset($histories) && count($histories) > 0)
                        @foreach($histories as $history)
                            <!-- History Item -->
                            <div class="history-item min-w-full px-4">
                                <div class="{{ $theme === 'dark' ? 'bg-gray-300' : 'bg-white' }} rounded-lg shadow-lg p-6 flex flex-col h-full">
                                    <div class="history-flex-container">
                                        <div class="history-image">
                                            @if(isset($history->hs_image))
                                                <img src="{{ $history->hs_image }}" alt="Pazar Seasoning {{ $history->hs_year }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="img/Web/history-placeholder.jpg" alt="Pazar Seasoning {{ $history->hs_year }}" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="history-content-wrapper">
                                            <div class="history-year">{{ $history->hs_year }}</div>
                                            <div class="history-content {{ $theme === 'dark' ? 'text-gray-800' : 'text-black' }}">
                                                {!! $history->hs_description_id !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
            <!-- Navigation buttons -->
            <button class="history-carousel-nav history-carousel-prev absolute top-1/2 left-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10" aria-label="Previous slide">
                <img src="img/Web/left.svg" alt="left icon" class="h-6 w-6">
            </button>
            <button class="history-carousel-nav history-carousel-next absolute top-1/2 right-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10" aria-label="Next slide">
                <img src="img/Web/right.svg" alt="right icon" class="h-6 w-6">
            </button>
            
            <!-- Carousel indicators -->
            <div class="history-carousel-indicators flex justify-center mt-8 space-x-2">
                <!-- These will be populated by JavaScript -->
            </div>
        </div>
    </div>
</section>

<!-- Quality Policy Section -->
@if(isset($companyPolicy))
<section class="quality-policy py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">Kebijakan Mutu</h2>
        
        <div class="prose prose-lg mx-auto {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">
            {!! nl2br(e($companyPolicy->cp_description_id)) !!}
        </div>
    </div>
</section>
@endif

<!-- Vision & Mission Section -->
<section class="vision-mission py-16 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row">
            <!-- Vision -->
            @if(isset($companyVision))
            <div class="flex-1 mb-8 md:mb-0">
                <h2 class="text-3xl font-bold mb-8 text-center {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">Visi</h2>
                <div class="prose prose-lg mx-auto {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }} px-4">
                    {!! nl2br(e($companyVision->cp_description_id)) !!}
                </div>
            </div>
            @endif
            
            <!-- Divider - Only visible on desktop (793px and above) -->
            <div class="hidden md:block w-px {{ $theme === 'dark' ? 'bg-gray-600' : 'bg-gray-300' }} mx-8 self-stretch"></div>
            
            <!-- Mobile Divider - Only visible on mobile (below 767px) -->
            <div class="md1:hidden w-full h-px {{ $theme === 'dark' ? 'bg-gray-600' : 'bg-gray-300' }} my-8"></div>
            
            <!-- Mission -->
            @if(isset($companyMission))
            <div class="flex-1">
                <h2 class="text-3xl font-bold mb-8 text-center {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">Misi</h2>
                <div class="prose prose-lg mx-auto {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }} px-4">
                    {!! nl2br(e($companyMission->cp_description_id)) !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
<script src="{{ asset('js/history-carousel.js') }}"></script>
@endsection