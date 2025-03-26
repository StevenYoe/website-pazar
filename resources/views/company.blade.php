@extends('master')

<!-- Company Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">Tentang Pazar Seasoning</p>
            <h1 class="text-5xl font-bold dark:text-gray-200">Sekilas Perusahaan</h1>
        </div>
        <div class="w-full max-w-4xl">
            <img src="img/Web/about.jpg" alt="Company-Overview" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Why Choose Us Section -->
<section class="why-choose-us py-20 bg-gray-50 dark:bg-gray-950 antialiased dark:text-gray-200">
    <div class="max-w-screen-xl mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-12">Why Choose Pazar Seasonings?</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4">
            <!-- Master Chefs Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="text-red-600 mb-4 group-hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">Master Chefs</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
            
            <!-- Quality Food Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="text-red-600 mb-4 group-hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">Quality Food</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
            
            <!-- Online Order Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="text-red-600 mb-4 group-hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-1.45-5c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.37-.66-.11-1.48-.87-1.48H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7l1.1-2h7.45zM6.16 6h12.15l-2.76 5H8.53L6.16 6z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">Online Order</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
            
            <!-- 24/7 Service Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="text-red-600 mb-4 group-hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 15.5c-1.25 0-2.45-.2-3.57-.57-.35-.11-.74-.03-1.02.24l-2.2 2.2c-2.83-1.44-5.15-3.75-6.59-6.59l2.2-2.21c.28-.26.36-.65.25-1C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.5c0-.55-.45-1-1-1zM19 12h2c0-4.97-4.03-9-9-9v2c3.87 0 7 3.13 7 7zm-4 0h2c0-2.76-2.24-5-5-5v2c1.66 0 3 1.34 3 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">24/7 Service</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection