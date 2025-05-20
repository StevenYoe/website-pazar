@extends('master')

@section('title', 'Info Karir - Pazar Seasonings')

<!-- Career Info Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">Karir</p>
            @if(isset($header))
                <h1 class="text-5xl font-bold dark:text-gray-200">{{ $header->h_title_id }}</h1>
            @else
                <h1 class="text-5xl font-bold dark:text-gray-200">Info Karir</h1>
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
<!-- Bekerja di Pazar Section -->
<section class="py-16 bg-white dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            @if(isset($workAtPazarWork))
                <h2 class="text-4xl font-bold mb-6 dark:text-gray-200">{{ $workAtPazarWork->wap_title_id }}</h2>
                <div class="max-w-4xl mx-auto text-lg leading-relaxed text-gray-600 dark:text-gray-300 space-y-6">
                    {!! nl2br(e($workAtPazarWork->wap_description_id)) !!}
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Kelebihan Pazar Section -->
<section class="py-16 bg-gray-100 dark:bg-gray-950 antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($workAtPazarWhy))
            <h2 class="text-4xl font-bold text-center mb-16 dark:text-gray-200">{{ $workAtPazarWhy->wap_title_id }}</h2>
        @endif
        
        @if(isset($careerInfos) && count($careerInfos) > 0)
            @foreach($careerInfos as $index => $info)
                <!-- Feature Item -->
                <div class="grid md:grid-cols-2 gap-12 items-center {{ $index < count($careerInfos) - 1 ? 'mb-20' : '' }}">
                    @if($index % 2 == 0)
                        <div>
                            <h3 class="text-3xl font-bold mb-6 text-custom-green dark:text-custom-lightgreen">{{ $info->ci_title_id }}</h3>
                            <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                                {{ $info->ci_description_id }}
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
                            <h3 class="text-3xl font-bold mb-6 text-custom-green dark:text-custom-lightgreen">{{ $info->ci_title_id }}</h3>
                            <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                                {{ $info->ci_description_id }}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-custom-green dark:bg-custom-green">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        @if(isset($workAtPazarJoin))
            <h2 class="text-4xl font-bold text-white mb-6">{{ $workAtPazarJoin->wap_title_id }}</h2>
            <p class="text-xl text-white mb-8 max-w-3xl mx-auto">
                {{ $workAtPazarJoin->wap_description_id }}
            </p>
        @endif
        <a href="/vacancies" class="inline-block bg-white hover:bg-gray-100 text-custom-green font-bold py-4 px-8 rounded-lg transition duration-300 text-lg">
            LIHAT LOWONGAN KERJA
        </a>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection