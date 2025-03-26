<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pazar Seasonings</title>
        <link rel="icon" href="img/web/Logo.ico" type="image/x-icon">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        @yield('style')
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <link href="https://db.onlinewebfonts.com/c/f5a6cacc1ecc1ccdc9e8563085f972ec?family=Nyte+W00+Black" rel="stylesheet">

        <style type="text/tailwindcss">
            @theme {
            --color-custom-lightergreen: #3fd144;
            --color-custom-lightgreen: #36b149;
            --color-custom-green: #116a2a;
            --color-custom-darkgreen: #0b5727;
            --color-custom-red: #BF161C;
            --breakpoint-md: 49.563rem; /* 793px  */
            --breakpoint-md1: 49.506rem; /* 792.1px  */
            }
        </style>
    </head>
    <body data-page="{{ Route::currentRouteName() }}">
        <header class="landing relative">
            <nav id="navbar" class="fixed w-full z-20 top-0 start-0 border-gray-200 dark:border-gray-600">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="img/web/Logo.png" class="h-14" alt="Pazar Logo">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md1:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>

                    <!-- Desktop Navigation -->
                    <div class="items-center justify-between hidden w-full md1:flex md1:w-auto md1:order-1" id="navbar-sticky">
                        <div class="flex flex-col md1:flex-row md1:items-center md1:space-x-4 w-full">
                            <!-- Main Navigation Items -->
                            <div class="flex flex-col md1:flex-row md1:space-x-4 w-full">
                                <div class="relative group w-full md1:w-auto">
                                    <button id="about-dropdown" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen dark:text-gray-200 dark:hover:text-custom-lightgreen">
                                        Tentang Kami
                                    </button>
                                    <div class="absolute left-0 z-10 hidden group-hover:block bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 md1:mt-0 mt-0">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li><a id="about-company" href="/company" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Sekilas Perusahaan</a></li>
                                            <li><a id="about-pazar" href="/history" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Sejarah Pazar</a></li>
                                            <li><a id="about-products" href="/products" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Produk</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="relative group w-full md1:w-auto">
                                    <button id="career-dropdown" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen dark:text-gray-200 dark:hover:text-custom-lightgreen">
                                        Karir
                                    </button>
                                    <div class="absolute left-0 z-10 hidden group-hover:block bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 md1:mt-0 mt-0">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li><a id="career-info" href="/careerinfo" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Info Karir</a></li>
                                            <li><a id="career-vacancies" href="/vacancies" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Lowongan</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right side items -->
                            <div class="flex flex-col md1:flex-row md1:items-center md1:space-x-4 mt-4 md1:mt-0 w-full md1:w-auto">
                                <!-- Language Dropdown -->
                                <div class="relative group w-full md1:w-auto">
                                    <button type="button" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-white dark:text-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 hover:text-custom-lightgreen dark:hover:bg-gray-700 dark:hover:text-white">
                                        <svg class="h-3.5 w-3.5 rounded-full me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="#ff0000" d="M0 0h512v256H0z"/> <!-- Merah di atas -->
                                            <path fill="#ffffff" d="M0 256h512v256H0z"/> <!-- Putih di bawah -->
                                        </svg>
                                        Indonesia                    
                                    </button>
                                    <!-- Language Dropdown content -->
                                    <div class="absolute md1:absolute right-0 z-50 hidden group-hover:block bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 w-full md1:w-44">
                                        <ul class="py-2 font-medium" role="none">
                                            <li>
                                                <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-400 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                        <svg class="h-3.5 w-3.5 rounded-full me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path fill="#ff0000" d="M0 0h512v256H0z"/> 
                                                            <path fill="#ffffff" d="M0 256h512v256H0z"/>
                                                        </svg>
                                                        Indonesia                                
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-400 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                        <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full me-2" xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-us" viewBox="0 0 512 512">
                                                            <g fill-rule="evenodd">
                                                                <g stroke-width="1pt">
                                                                    <path fill="#bd3d44" d="M0 0h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/>
                                                                    <path fill="#fff" d="M0 10h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z" transform="scale(3.9385)"/>
                                                                </g>
                                                                <path fill="#192f5d" d="M0 0h98.8v70H0z" transform="scale(3.9385)"/>
                                                                <path fill="#fff" d="M8.2 3l1 2.8H12L9.7 7.5l.9 2.7-2.4-1.7L6 10.2l.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7L74 8.5l-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 7.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 24.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 21.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 38.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 35.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 52.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 49.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 66.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 63.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9z" transform="scale(3.9385)"/>
                                                            </g>
                                                        </svg>              
                                                        English (US)
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Buy Now Dropdown -->
                                <div class="relative group w-full md1:w-auto">
                                    <button id="dropdownHoverButton" class="text-white dark:text-gray-200 bg-custom-lightgreen hover:bg-custom-green focus:ring-4 focus:outline-none focus:bg-custom-lightergreen font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center justify-between dark:bg-custom-lightgreen dark:hover:bg-custom-green dark:focus:bg-custom-darkgreen w-full md:w-auto" type="button">
                                        Beli Sekarang
                                    </button>
                                    
                                    <!-- Buy Now Dropdown menu -->
                                    <div class="absolute left-0 md1:left-auto md1:right-0 z-10 hidden group-hover:block bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-full md1:w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li><a href="https://shopee.co.id/pazar_seasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Shopee</a></li>
                                            <li><a href="https://www.tokopedia.com/pazarseasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Tokopedia</a></li>
                                            <li><a href="https://www.blibli.com/merchant/pazar-seasonings/PAS-70580" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Blibli</a></li>
                                            <li><a href="https://www.lazada.co.id/shop/pazar-seasonings/" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Lazada</a></li>
                                            <li><a href="https://www.tiktok.com/@pazar.seasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Tiktok Shop</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Header Section -->
            @yield('header')
        </header>
        
        @yield('content')

        <footer class="bg-custom-red text-white dark:text-gray-200 antialiased">
            <div class="max-w-screen-xl mx-auto px-4 py-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Logo Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <img src="img/web/Logo.png" class="h-16 mb-4" alt="Pazar Logo">
                        <h3 class="text-xl font-semibold mb-2">Kantor Pusat</h3>
                        <a href="https://g.co/kgs/K4ckX4k" target="_blank" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                            PT Pristine Prima Lestari<br>
                            Jl. Vihara No.2, Curug Kulon,<br>
                            Kec. Curug, Kabupaten Tangerang,<br>
                            Banten 15820
                        </a>
                    </div>
                    
                    <!-- Contact Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-xl font-semibold mb-4">Hubungi Kami</h3>
                        <div class="flex items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="#" target="_blank" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                <span>info@pazarseasonings.com</span>
                            </a>
                        </div>
                        <div class="flex items-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="#" target="_blank" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                <span>+62 21 5989 4255</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Social Media Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-xl font-semibold mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.instagram.com/pazarseasonings" target="_blank" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/pazarseasonings" target="_blank" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/628174918835" target="_blank" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2.004 22l1.352-4.968A9.954 9.954 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.954 9.954 0 0 1-5.03-1.355L2.004 22zM8.391 7.308a.961.961 0 0 0-.371.1 1.293 1.293 0 0 0-.294.228c-.12.113-.188.211-.261.306A2.729 2.729 0 0 0 6.9 9.62c.002.49.13.967.33 1.413.409.902 1.082 1.857 1.971 2.742.214.213.423.427.648.626a9.448 9.448 0 0 0 3.84 2.046l.569.087c.185.01.37-.004.556-.013a1.99 1.99 0 0 0 .833-.231c.166-.088.244-.132.383-.22 0 0 .043-.028.125-.09.135-.1.218-.171.33-.288.083-.086.155-.187.21-.302.078-.163.156-.474.188-.733.024-.198.017-.306.014-.373-.004-.107-.093-.218-.19-.265l-.582-.261s-.87-.379-1.401-.621a.498.498 0 0 0-.177-.041.482.482 0 0 0-.378.127v-.002c-.005 0-.072.057-.795.933a.35.35 0 0 1-.368.13 1.416 1.416 0 0 1-.191-.066c-.124-.052-.167-.072-.252-.109l-.005-.002a6.01 6.01 0 0 1-1.57-1c-.126-.11-.243-.23-.363-.346a6.296 6.296 0 0 1-1.02-1.268l-.059-.095a.923.923 0 0 1-.102-.205c-.038-.147.061-.265.061-.265s.243-.266.356-.41a4.38 4.38 0 0 0 .263-.373c.118-.19.155-.385.093-.536-.28-.684-.57-1.365-.868-2.041-.059-.134-.234-.23-.393-.249-.054-.006-.108-.012-.162-.016a3.385 3.385 0 0 0-.403.004z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright Section -->
            <div class="bg-black py-4">
                <div class="max-w-screen-xl mx-auto px-4 text-center">
                    <p>&copy; 2025 Pazar Seasonings. PT Pristine Prima Lestari. All Rights Reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Back to top button -->
        <button
            type="button"
            data-twe-ripple-init
            data-twe-ripple-color="light"
            class="!fixed bottom-5 end-5 hidden rounded-full bg-red-600 p-3 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg"
            id="btn-back-to-top">
            <span class="[&>svg]:w-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="3"
                    stroke="currentColor">
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                </svg>
            </span>
        </button>

        @yield('script')

    </body>
</html>