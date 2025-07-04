<!--
    careerinfo.blade.php
    
    This Blade template renders the Career Info page, including:
    - The header section with a dynamic title and image
    - The "Working at Pazar" section with a description
    - The "Why Pazar" section with alternating feature items
    - The call-to-action section inviting users to view job vacancies
    - All sections are responsive and theme-aware (dark/light)
    - JavaScript is included for interactivity (main.js, back-to-top.js)
    
    Comments are provided throughout to help programmers understand the structure and logic.
-->
@extends('master')

@section('title', __('general.career_info') . ' - Pazar Seasonings')

<!-- Career Info Header Section: displays the main title and header image for the career info page -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400">{{ __('general.career') }}</p>
            @if(isset($header))
                <h1 class="text-5xl font-bold {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }}">
                    {{ app()->getLocale() == 'en' ? $header->h_title_en : $header->h_title_id }}
                </h1>
            @endif
        </div>
        <div class="w-full max-w-4xl">
            @if(isset($header) && $header->h_image)
                <img src="{{ $header->h_image }}" alt="Career-Overview" class="rounded-lg shadow-lg w-full">
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Working at Pazar Section: shows what it's like to work at Pazar -->
<section class="py-16 {{ $theme === 'dark' ? 'bg-gray-900' : 'bg-white' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            @if(isset($workAtPazarWork))
                <h2 class="text-4xl font-bold mb-6 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">
                    {!! app()->getLocale() == 'en' ? $workAtPazarWork->wap_title_en : $workAtPazarWork->wap_title_id !!}
                </h2>
                <div class="max-w-4xl mx-auto text-lg leading-relaxed {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-600' }} space-y-6">
                    {!! app()->getLocale() == 'en' ? nl2br(e($workAtPazarWork->wap_description_en)) : nl2br(e($workAtPazarWork->wap_description_id)) !!}
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Why Pazar Section: highlights the advantages of working at Pazar with alternating image/text layout -->
<section class="py-16 {{ $theme === 'dark' ? 'bg-gray-800' : 'bg-gray-100' }} antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($workAtPazarWhy))
            <h2 class="text-4xl font-bold text-center mb-16 {{ $theme === 'dark' ? 'text-gray-200' : 'text-black' }}">
                {!! app()->getLocale() == 'en' ? $workAtPazarWhy->wap_title_en : $workAtPazarWhy->wap_title_id !!}
            </h2>
        @endif
        
        @if(isset($careerInfos) && count($careerInfos) > 0)
            @foreach($careerInfos as $index => $info)
                <!-- Feature Item: alternates image/text left and right for each item -->
                <div class="grid md:grid-cols-2 gap-12 items-center {{ $index < count($careerInfos) - 1 ? 'mb-20' : '' }}">
                    @if($index % 2 == 0)
                        <div>
                            <h3 class="text-3xl font-bold mb-6 {{ $theme === 'dark' ? 'text-custom-lightgreen' : 'text-custom-green' }}">
                                {!! app()->getLocale() == 'en' ? $info->ci_title_en : $info->ci_title_id !!}
                            </h3>
                            <p class="text-lg leading-relaxed {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-600' }}">
                                {!! app()->getLocale() == 'en' ? $info->ci_description_en : $info->ci_description_id !!}
                            </p>
                        </div>
                        <div>
                            <img src="{{ $info->ci_image }}" alt="{{ $info->ci_title_id }}" class="rounded-lg shadow-lg w-full h-auto">
                        </div>
                    @else
                        <div class="order-2 md:order-1">
                            <img src="{{ $info->ci_image }}" alt="{{ $info->ci_title_id }}" class="rounded-lg shadow-lg w-full h-auto">
                        </div>
                        <div class="order-1 md:order-2">
                            <h3 class="text-3xl font-bold mb-6 {{ $theme === 'dark' ? 'text-custom-lightgreen' : 'text-custom-green' }}">
                                {!! app()->getLocale() == 'en' ? $info->ci_title_en : $info->ci_title_id !!}
                            </h3>
                            <p class="text-lg leading-relaxed {{ $theme === 'dark' ? 'text-gray-300' : 'text-gray-600' }}">
                                {!! app()->getLocale() == 'en' ? $info->ci_description_en : $info->ci_description_id !!}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</section>

<!-- Call to Action Section: encourages users to view job vacancies -->
<section class="py-16 bg-custom-green">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        @if(isset($workAtPazarJoin))
            <h2 class="text-4xl font-bold text-white mb-6">
                {!! app()->getLocale() == 'en' ? $workAtPazarJoin->wap_title_en : $workAtPazarJoin->wap_title_id !!}
            </h2>
            <p class="text-xl text-white mb-8 max-w-3xl mx-auto">
                {!! app()->getLocale() == 'en' ? $workAtPazarJoin->wap_description_en : $workAtPazarJoin->wap_description_id !!}
            </p>
        @endif
        <a href="{{ route(app()->getLocale() . '.vacancies') }}" class="inline-block bg-white hover:bg-gray-100 text-custom-green font-bold py-4 px-8 rounded-lg transition duration-300 text-lg">
            {{ __('general.view_job') }}
        </a>
    </div>
</section>
@endsection

@section('script')
<!-- JavaScript includes for interactivity: navigation, back-to-top, etc. -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection