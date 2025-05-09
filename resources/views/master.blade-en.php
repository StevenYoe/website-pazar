<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pazar Seasonings</title>
        <link rel="icon" href="{{ asset('img/web/Logo.ico') }}" type="image/x-icon">
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
            <!-- Navbar Section - This will be visible on all pages including product-detail -->
            <nav id="navbar" class="fixed w-full z-20 top-0 start-0 border-gray-200 dark:border-gray-600 @if(Route::currentRouteName() == 'products.show') bg-custom-red @endif">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('img/web/Logo.png') }}" class="h-14" alt="Pazar Logo">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md1:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <img src="{{ asset('img/web/mobilemenu.svg') }}" alt="mobile menu" class="w-5 h-5">
                    </button>

                    <!-- Desktop Navigation -->
                    <div class="items-center justify-between hidden w-full md1:flex md1:w-auto md1:order-1" id="navbar-sticky">
                        <!-- Navigation content remains the same -->
                        <div class="flex flex-col md1:flex-row md1:items-center md1:space-x-4 w-full">
                            <!-- Main Navigation Items -->
                            <div class="flex flex-col md1:flex-row md1:space-x-4 w-full">
                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-company" href="/company" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen dark:text-gray-200 dark:hover:text-custom-lightgreen">
                                        Our Company
                                    </a>
                                </div>

                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-brand" href="/brand" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen dark:text-gray-200 dark:hover:text-custom-lightgreen">
                                        Our Brand
                                    </a>
                                </div>

                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-products" href="/products" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen dark:text-gray-200 dark:hover:text-custom-lightgreen">
                                        Products
                                    </a>
                                </div>

                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-recipes" href="/recipes" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen dark:text-gray-200 dark:hover:text-custom-lightgreen">
                                        Recipes
                                    </a>
                                </div>

                                <div class="relative group w-full md1:w-auto">
                                    <button id="career-dropdown" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen dark:text-gray-200 dark:hover:text-custom-lightgreen">
                                        Career
                                    </button>
                                    <div class="absolute left-0 z-10 hidden group-hover:block bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 md1:mt-0 mt-0">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li><a id="career-info" href="/careerinfo" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Career Info</a></li>
                                            <li><a id="career-vacancies" href="/vacancies" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Vacancies</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right side items -->
                            <div class="flex flex-col md1:flex-row md1:items-center md1:space-x-4 mt-4 md1:mt-0 w-full md1:w-auto">
                                <!-- Language Dropdown -->
                                <div class="relative group w-full md1:w-auto">
                                    <button type="button" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-white dark:text-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 hover:text-custom-lightgreen dark:hover:bg-gray-700 dark:hover:text-white">
                                    <img src="{{ asset('img/Web/USA.svg')}}" alt="USA Flag" class="h-3.5 w-3.5 rounded-full me-2">
                                        English (US)                    
                                    </button>
                                    <!-- Language Dropdown content -->
                                    <div class="absolute md1:absolute right-0 z-50 hidden group-hover:block bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 w-full md1:w-44">
                                        <ul class="py-2 font-medium" role="none">
                                            <li>
                                                <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-400 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                    <img src="{{ asset('img/Web/Indonesia.svg')}}" alt="Indonesia Flag" class="h-3.5 w-3.5 rounded-full me-2">
                                                        Indonesia                                
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-400 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white" role="menuitem">
                                                    <div class="inline-flex items-center">
                                                    <img src="{{ asset('img/Web/USA.svg')}}" alt="USA Flag" class="h-3.5 w-3.5 rounded-full me-2">
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
                                        Buy Now
                                    </button>
                                    
                                    <!-- Buy Now Dropdown menu -->
                                    <div class="absolute left-0 md1:left-auto md1:right-0 z-10 hidden group-hover:block bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-full md1:w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li><a href="https://shopee.co.id/pazar_seasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Shopee</a></li>
                                            <li><a href="https://www.tokopedia.com/pazarseasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Tokopedia</a></li>
                                            <li><a href="https://www.blibli.com/merchant/pazar-seasonings/PAS-70580" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Blibli</a></li>
                                            <li><a href="https://www.lazada.co.id/shop/pazar-seasonings/" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Lazada</a></li>
                                            <li><a href="https://www.tiktok.com/@pazar.seasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Tiktok Shop</a></li>
                                            <li><a href="https://www.bukalapak.com/u/pazarseasonings_113090" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen dark:hover:bg-custom-lightergreen dark:hover:text-white">Bukalapak</a></li>
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

        <!-- Footer Section -->
        <footer class="bg-custom-red text-white dark:text-gray-200 antialiased">
            <div class="max-w-screen-xl mx-auto px-4 py-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Logo Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <img src="{{ asset('img/web/Logo.png')}}" class="h-16 mb-4" alt="Pazar Logo">
                        @if(isset($footerData) && isset($footerData['address']) && $footerData['address'])
                            <h3 class="text-xl font-semibold mb-2">Kantor Pusat</h3>
                            <a href="{{ $footerData['address']->f_link ?? '#' }}" target="_blank" class="text-center md:text-left text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                <p class="font-medium">{{ $footerData['address']->f_label_en }}</p>
                                <p class="mt-1 whitespace-normal break-words">{!! nl2br(e($footerData['address']->f_description_en ?? '')) !!}</p>
                            </a>
                        @endif
                    </div>
                    
                    <!-- Contact Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-xl font-semibold mb-4">Hubungi Kami</h3>
                        @if(isset($footerData) && isset($footerData['contacts']) && count($footerData['contacts']) > 0)
                            @foreach($footerData['contacts'] as $contact)
                                <div class="flex items-center mb-3">
                                    @if(isset($contact->f_icon) && $contact->f_icon)
                                        <img src="{{ $contact->f_icon }}" alt="{{ $contact->f_label_en ?? 'Contact' }} Icon" class="h-5 w-5 mr-2">
                                    @endif
                                    <a href="{{ $contact->f_link ?? '#' }}" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                        <span>{{ $contact->f_description_en ?? $contact->f_label_en ?? 'Contact Us' }}</span>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <!-- Social Media Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-xl font-semibold mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-4">
                            @if(isset($footerData) && isset($footerData['socials']) && count($footerData['socials']) > 0)
                                @foreach($footerData['socials'] as $social)
                                    <a href="{{ $social->f_link ?? '#' }}" target="_blank" class="text-white dark:text-gray-200 hover:text-custom-lightergreen">
                                        @if(isset($social->f_icon) && $social->f_icon)
                                            <img src="{{ $social->f_icon }}" alt="{{ $social->f_label_en ?? 'Social' }} Icon" class="h-6 w-6">
                                        @endif
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright Section -->
            <div class="bg-black py-4">
                <div class="max-w-screen-xl mx-auto px-4 text-center">
                    <p>&copy; <script>document.write(new Date().getFullYear())</script> Pazar Seasonings. PT Pristine Prima Lestari. All Rights Reserved.</p>
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
            <img src="{{ asset('img/Web/totop.svg')}}" alt="Back to top" class="w-4">
        </button>

        @yield('script')

    </body>
</html>