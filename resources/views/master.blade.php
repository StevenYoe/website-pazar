<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ $theme === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Basic SEO Meta Tags -->
        <title>@yield('title',  __('general.app_name'))</title>
        <meta name="description" content="@yield('description', __('general.meta_description'))">
        <meta name="keywords" content="@yield('keywords', __('general.meta_keywords'))">
        <meta name="author" content="Steven-MNP">
        <meta name="robots" content="index, follow">
        <meta name="language" content="{{ app()->getLocale() == 'id' ? 'Indonesian' : 'English' }}">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">
        <link rel="alternate" hreflang="id" href="{{ url()->current() }}?lang=id">
        <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">
        <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
        
        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="@yield('og_title', __('general.og_title'))">
        <meta property="og:description" content="@yield('og_description', __('general.og_description'))">
        <meta property="og:image" content="@yield('og_image', asset('img/web/Logo.png'))">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="@yield('og_type', 'website')">
        <meta property="og:locale" content="{{ app()->getLocale() == 'id' ? 'id_ID' : 'en_US' }}">
        <meta property="og:site_name" content="Pazar Seasonings">
        
        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('twitter_title', __('general.twitter_title'))">
        <meta name="twitter:description" content="@yield('twitter_description', __('general.twitter_description'))">
        <meta name="twitter:image" content="@yield('twitter_image', asset('img/web/Logo.png'))">
        
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/web/Logo.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('img/web/Logo.png') }}">
        
        <!-- Stylesheets -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
        @yield('style')
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <link href="https://fonts.cdnfonts.com/css/roboto" rel="stylesheet">
        
        <!-- Preconnect for performance -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        
        <!-- Multilingual SEO -->
        {!! \App\Helpers\LanguageHelper::getHreflangTags() !!}
        
        <!-- JSON-LD Structured Data -->
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "PT Pristine Prima Lestari",
                "alternateName": "Pazar Seasonings",
                "url": "{{ url('/') }}",
                "logo": "{{ asset('img/web/Logo.png') }}",
                "description": "{{ __('general.meta_description') }}",
                "address": {
                    "@type": "PostalAddress",
                    "addressCountry": "ID",
                    "addressRegion": "Banten",
                    "addressLocality": "Kabupaten Tangerang",
                    "streetAddress": "Curug"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "contactType": "customer service",
                    "availableLanguage": ["Indonesian", "English"]
                },
                "sameAs": [
                    "https://shopee.co.id/pazar_seasonings",
                    "https://www.tokopedia.com/pazarseasonings",
                    "https://www.blibli.com/merchant/pazar-seasonings/PAS-70580",
                    "https://www.lazada.co.id/shop/pazar-seasonings/",
                    "https://www.tiktok.com/@pazar.seasonings",
                    "https://www.bukalapak.com/u/pazarseasonings_113090"
                ],
                "numberOfEmployees": {
                    "@type": "QuantitativeValue",
                    "value": "100-200"
                },
                "foundingDate": "2016",
                "industry": "Spice Manufacturing",
                "knowsAbout": [
                    "{{ app()->getLocale() == 'id' ? 'Bumbu Instan' : 'Instant Seasonings' }}",
                    "Seasonings",
                    "{{ app()->getLocale() == 'id' ? 'Rempah' : 'Spices' }}",
                    "{{ app()->getLocale() == 'id' ? 'Sambal' : 'Chili Paste' }}",
                    "{{ app()->getLocale() == 'id' ? 'Kondimen' : 'Condiments' }}"
                ]
            }
        </script>

        <script>
            // Check if dark mode is saved in cookie
            function getThemeCookie() {
                let cookies = document.cookie.split('; ');
                for (let cookie of cookies) {
                    let [name, value] = cookie.split('=');
                    if (name === 'theme') {
                        return value;
                    }
                }
                return 'light'; // Default theme if not set
            }
            // Apply theme class to html tag
            const theme = getThemeCookie();
            document.documentElement.className = theme === 'dark' ? 'dark' : '';
        </script>

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
            <nav id="navbar" class="fixed w-full z-20 top-0 start-0 {{ $theme === 'dark' ? 'dark border-gray-600 text-white' : 'border-gray-200' }}
            @if(Route::currentRouteName() == 'products.show' || Route::currentRouteName() == 'recipe.show' || Route::currentRouteName() == 'vacancy.show') bg-custom-red scrolled @endif" data-breakpoint="793">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <!-- Logo Link - Preserve Language -->
                    <a href="{{ route(app()->getLocale() . '.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('img/web/Logo.webp') }}" class="h-14" alt="Pazar Logo">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"></span>
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md1:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <img src="{{ asset('img/web/mobilemenu.svg') }}" alt="mobile menu" class="w-5 h-5">
                    </button>
                    
                    <!-- Desktop Navigation -->
                    <div class="items-center justify-between hidden w-full md1:flex md1:w-auto md1:order-1" id="navbar-sticky">
                        <div class="flex flex-col md1:flex-row md1:items-center w-full justify-between">
                            <!-- Main Navigation Items -->
                            <div class="flex flex-col md1:flex-row md1:space-x-4 md1:ml-16">
                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-company" href="{{ route(app()->getLocale() . '.company') }}"
                                        class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen {{ $theme === 'dark' ? 'text-white' : 'text-white' }}">
                                        {{ __('general.company') }}
                                    </a>
                                </div>
                                
                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-brand" href="{{ route(app()->getLocale() . '.brand') }}"
                                        class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen {{ $theme === 'dark' ? 'text-white' : 'text-white' }}">
                                        {{ __('general.brand') }}
                                    </a>
                                </div>
                                
                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-products" href="{{ route(app()->getLocale() . '.products') }}"
                                        class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen {{ $theme === 'dark' ? 'text-white' : 'text-white' }}">
                                        {{ __('general.products') }}
                                    </a>
                                </div>
                                
                                <div class="relative group w-full md1:w-auto">
                                    <a id="nav-recipes" href="{{ route(app()->getLocale() . '.recipes') }}"
                                        class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen {{ $theme === 'dark' ? 'text-white' : 'text-white' }}">
                                        {{ __('general.recipes') }}
                                    </a>
                                </div>
                                
                                <!-- Career Dropdown -->
                                <div class="relative group w-full md1:w-auto">
                                    <button id="career-dropdown" class="flex items-center justify-between w-full py-2 px-3 text-white rounded-sm md1:hover:text-custom-lightgreen {{ $theme === 'dark' ? 'text-white' : 'text-white' }}">
                                        {{ __('general.career') }}
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <div class="absolute left-0 z-10 hidden group-hover:block {{ $theme === 'dark' ? 'bg-gray-700' : 'bg-white' }} divide-y divide-gray-100 rounded-lg shadow-sm w-44 md1:mt-0 mt-0">
                                        <ul class="py-2 text-sm {{ $theme === 'dark' ? 'text-white' : 'text-gray-700' }}">
                                            <li>
                                                <a id="career-info" href="{{ route(app()->getLocale() . '.careerinfo') }}"
                                                    class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">
                                                    {{ __('general.career_info') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a id="career-vacancies" href="{{ route(app()->getLocale() . '.vacancies') }}"
                                                    class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">
                                                    {{ __('general.vacancies') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right side items -->
                            <div class="flex flex-col md1:flex-row md1:items-center space-x-0 md1:space-x-1 mt-4 md1:mt-0">
                                <!-- Language Dropdown -->
                                <div class="relative group w-full md1:w-auto">
                                    <button type="button" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-white rounded-lg cursor-pointer hover:bg-gray-100 hover:text-custom-lightgreen {{ $theme === 'dark' ? 'hover:bg-gray-700 hover:text-white' : 'hover:bg-gray-100 hover:text-custom-lightgreen' }} w-full">
                                        @if(app()->getLocale() == 'id')
                                            <img src="{{ asset('img/Web/Indonesia.svg') }}" alt="Indonesia Flag" class="h-3.5 w-3.5 rounded-full me-2"> Indonesia
                                        @else
                                            <img src="{{ asset('img/Web/USA.svg') }}" alt="USA Flag" class="h-3.5 w-3.5 rounded-full me-2"> English (US)
                                        @endif
                                    </button>
                                    <div class="absolute md1:absolute right-0 z-50 hidden group-hover:block {{ $theme === 'dark' ? 'bg-gray-700' : 'bg-white' }} divide-y divide-gray-100 rounded-lg shadow-sm w-full md1:w-44">
                                        <ul class="py-2 font-medium {{ $theme === 'dark' ? 'text-white' : 'text-gray-700' }}" role="none">
                                            @foreach(config('app.available_locales') as $locale => $language)
                                            <li>
                                                <a href="{{ route('language.switch', $locale) }}"
                                                    class="block px-4 py-2 text-sm hover:bg-custom-lightergreen hover:text-white {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen bg-gray-600' : 'hover:bg-custom-lightergreen bg-gray-100' }}"
                                                    role="menuitem">
                                                    <div class="inline-flex items-center">
                                                        <img src="{{ asset($language['flag']) }}" alt="{{ $language['name'] }} Flag" class="h-3.5 w-3.5 rounded-full me-2"> {{ $language['native'] }}
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                
                                <!-- Theme Toggle Button -->
                                <div class="relative group w-full md1:w-auto">
                                    <a href="{{ route('theme.toggle') }}"
                                        class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-white dark:text-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 hover:text-custom-lightgreen dark:hover:bg-gray-700 dark:hover:text-white w-full">
                                        @if($theme === 'dark')
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ __('general.light_mode') }}
                                        @else
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                            </svg>
                                            {{ __('general.dark_mode') }}
                                        @endif
                                    </a>
                                </div>
                                
                                <!-- Buy Now Dropdown -->
                                <div class="relative group w-full md1:w-auto">
                                    <button id="dropdownHoverButton" class="{{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }} bg-custom-lightgreen hover:bg-custom-green focus:ring-4 focus:outline-none focus:bg-custom-lightergreen font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center justify-between {{ $theme === 'dark' ? 'bg-custom-lightgreen hover:bg-custom-green focus:bg-custom-darkgreen' : 'bg-custom-lightgreen hover:bg-custom-green focus:bg-custom-lightergreen' }} w-full md:w-auto" type="button">
                                        {{ __('general.buy_now') }}
                                    </button>
                                    <div class="absolute left-0 md1:left-auto md1:right-0 z-10 hidden group-hover:block {{ $theme === 'dark' ? 'bg-gray-700' : 'bg-white' }} divide-y divide-gray-100 rounded-lg shadow-sm w-full md1:w-44">
                                        <ul class="py-2 text-sm {{ $theme === 'dark' ? 'text-gray-200' : 'text-gray-700' }}">
                                            <li><a href="https://shopee.co.id/pazar_seasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">Shopee</a></li>
                                            <li><a href="https://www.tokopedia.com/pazarseasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">Tokopedia</a></li>
                                            <li><a href="https://www.blibli.com/merchant/pazar-seasonings/PAS-70580" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">Blibli</a></li>
                                            <li><a href="https://www.lazada.co.id/shop/pazar-seasonings/" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">Lazada</a></li>
                                            <li><a href="https://www.tiktok.com/@pazar.seasonings" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">Tiktok Shop</a></li>
                                            <li><a href="https://www.bukalapak.com/u/pazarseasonings_113090" target="_blank" class="block px-4 py-2 hover:bg-custom-lightergreen {{ $theme === 'dark' ? 'hover:bg-custom-lightergreen hover:text-white' : 'hover:bg-custom-lightergreen hover:text-white' }}">Bukalapak</a></li>
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

        <!-- Update footer section di master.blade.php -->
        <footer class="bg-custom-red {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }} antialiased">
            <div class="max-w-screen-xl mx-auto px-4 py-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Logo Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <img src="{{ asset('img/web/Logo.webp')}}" class="h-16 mb-4" alt="Pazar Logo">
                        @if(isset($footerData) && isset($footerData['address']) && $footerData['address'])
                            <h3 class="text-xl font-semibold mb-2">{{ __('general.headquarters') }}</h3>
                            <a href="{{ $footerData['address']->f_link ?? '#' }}" target="_blank" class="text-center md:text-left {{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }} hover:text-custom-lightergreen">
                                <p class="font-medium">
                                    {{ app()->getLocale() == 'en' ? ($footerData['address']->f_label_en ?? $footerData['address']->f_label_id) : $footerData['address']->f_label_id }}
                                </p>
                                <p class="mt-1 whitespace-normal break-words">
                                    {!! nl2br(e(app()->getLocale() == 'en' ? ($footerData['address']->f_description_en ?? $footerData['address']->f_description_id) : $footerData['address']->f_description_id)) !!}
                                </p>
                            </a>
                        @endif
                    </div>
                    
                    <!-- Contact Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-xl font-semibold mb-4">{{ __('general.contact_us') }}</h3>
                        @if(isset($footerData) && isset($footerData['contacts']) && count($footerData['contacts']) > 0)
                            @foreach($footerData['contacts'] as $contact)
                                <div class="flex items-center mb-3">
                                    @if(isset($contact->f_icon) && $contact->f_icon)
                                        <img src="{{ $contact->f_icon }}" alt="{{ $contact->f_label_id ?? 'Contact' }} Icon" class="h-5 w-5 mr-2">
                                    @endif
                                    <a href="{{ $contact->f_link ?? '#' }}" class="{{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }} hover:text-custom-lightergreen">
                                        <span>
                                            {{ app()->getLocale() == 'en' ? ($contact->f_description_en ?? $contact->f_description_id) : $contact->f_description_id }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <!-- Social Media Section -->
                    <div class="flex flex-col items-center md:items-start">
                        <h3 class="text-xl font-semibold mb-4">{{ __('general.follow_us') }}</h3>
                        <div class="flex space-x-4">
                            @if(isset($footerData) && isset($footerData['socials']) && count($footerData['socials']) > 0)
                                @foreach($footerData['socials'] as $social)
                                    <a href="{{ $social->f_link ?? '#' }}" target="_blank" class="{{ $theme === 'dark' ? 'text-gray-200' : 'text-white' }} hover:text-custom-lightergreen">
                                        @if(isset($social->f_icon) && $social->f_icon)
                                            <img src="{{ $social->f_icon }}" alt="{{ $social->f_label_id ?? 'Social' }} Icon" class="h-6 w-6">
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
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>