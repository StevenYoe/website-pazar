@extends('master')

<!-- Hero/Header Section -->
@section('header')
<div class="landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="grid md:grid-cols-2 gap-8 items-center">
        <div class="text-white">
            @if(isset($header))
                <h1 class="text-5xl font-bold mb-6 dark:text-gray-200">{{ $header->h_title_id }}</h1>
                <p class="text-xl mb-8 dark:text-gray-200">{{ $header->h_description_id }}</p>
            @endif
            <a href="/company" class="inline-block bg-custom-lightgreen hover:bg-custom-green text-white dark:text-gray-200 font-bold py-3 px-8 rounded-lg transition duration-300">
                SELENGKAPNYA
            </a>
        </div>
        <div>
            @if(isset($header) && $header->h_image)
                <img src="{{ $header->h_image }}" alt="Pazar Products" class="rounded-lg shadow-lg">
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Pop-up Modal -->
@if(isset($popup) && $popup->pu_is_active)
<div id="popupModal" class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="relative bg-transparent rounded-lg shadow-lg max-w-2xl flex flex-col items-center">
        <!-- Container with relative positioning -->
        <div class="relative">
            <!-- Image Link -->
            <a href="{{ $popup->pu_link ?? 'https://shopee.co.id/pazar_seasonings' }}">
                <img src="{{ $popup->pu_image ?? 'img/web/popup-banner1.jpg' }}" alt="Pop Up Foto" 
                    class="mx-auto rounded-lg transition-opacity duration-300 hover:opacity-75 max-h-[600px] max-w-[80%] w-auto" />
            </a>
            
            <!-- Close Button - Positioned absolutely inside the top right corner of the image -->
            <button id="closeModal" class="absolute top-1 right-[calc(10%+3px)] bg-gray-200 hover:bg-gray-300 rounded-full p-2 flex items-center justify-center">
                <img src="img/Web/close.svg" class="w-5 h-5">
            </button>
        </div>
    </div>
</div>
@endif

<!-- Why Choose Us Section -->
<section class="why-choose-us py-20 bg-gray-50 dark:bg-gray-950 antialiased dark:text-gray-200">
    <div class="max-w-screen-xl mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-12">Why Choose Pazar Seasonings?</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4">
            <!-- Master Chefs Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="mb-4">
                    <img src="img/Web/man.svg" alt="call icon" class="h-12 w-12 group-hover:invert group-hover:brightness-0 group-hover:contrast-100">
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">Master Chefs</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
            
            <!-- Quality Food Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="mb-4">
                    <img src="img/Web/utensil.svg" alt="utensil icon" class="h-12 w-12 group-hover:invert group-hover:brightness-0 group-hover:contrast-100">
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">Quality Food</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
            
            <!-- Online Order Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="mb-4">
                    <img src="img/Web/cart.svg" alt="cart icon" class="h-12 w-12 group-hover:invert group-hover:brightness-0 group-hover:contrast-100">
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">Online Order</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
            
            <!-- 24/7 Service Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-col h-full hover:bg-yellow-400 transition-all duration-300 group max-w-xs mx-auto w-full">
                <div class="mb-4">
                    <img src="img/Web/call.svg" alt="call icon" class="h-12 w-12 group-hover:invert group-hover:brightness-0 group-hover:contrast-100">
                </div>
                <h3 class="text-xl font-bold mb-2 group-hover:text-white dark:text-black">24/7 Service</h3>
                <p class="text-gray-600 dark:text-gray-800 group-hover:text-white">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
            </div>
        </div>
    </div>
</section>

<!-- Product Category Section -->
<section class="product-category py-10 bg-white dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-12 dark:text-gray-200">Our Product Categories</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4">
            @if(isset($productCategories) && count($productCategories) > 0)
                @foreach($productCategories as $category)
                    <div class="category-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $category->pc_image ?? 'img/Category/default-category.jpg' }}" alt="{{ $category->pc_title_id }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold mb-2">{{ $category->pc_title_id }}</h3>
                            <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">{{ $category->pc_description_id }}</p>
                            <a href="/products?category={{ $category->pc_id }}" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback to static content if no categories are available -->
                <!-- Bumbu Instan Card -->
                <div class="category-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                    <div class="h-48 overflow-hidden">
                        <img src="img/Category/bumbu-instan.jpg" alt="Bumbu Instan" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-2">Bumbu Instan</h3>
                        <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Bumbu instan berkualitas tinggi untuk membuat masakan rumah dengan rasa autentik</p>
                        <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                    </div>
                </div>
                
                <!-- Sambal Card -->
                <div class="category-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                    <div class="h-48 overflow-hidden">
                        <img src="img/Category/sambal.jpg" alt="Sambal" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-2">Sambal</h3>
                        <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Sambal dengan cita rasa pedas yang khas untuk pelengkap hidangan favorit</p>
                        <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                    </div>
                </div>
                
                <!-- Rempah Card -->
                <div class="category-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                    <div class="h-48 overflow-hidden">
                        <img src="img/Category/rempah.jpg" alt="Rempah" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-2">Rempah</h3>
                        <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Rempah pilihan berkualitas untuk meningkatkan aroma dan cita rasa masakan</p>
                        <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                    </div>
                </div>
                
                <!-- Produk Spesial Card -->
                <div class="category-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                    <div class="h-48 overflow-hidden">
                        <img src="img/Category/produk-spesial.jpg" alt="Produk Spesial" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold mb-2">Produk Spesial</h3>
                        <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Tepung bumbu praktis untuk gorengan renyah dan gurih dalam sekejap</p>
                        <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Latest Recipe Section -->
@if(isset($latestRecipe))
<section class="latest-recipe py-10 bg-gray-50 dark:bg-gray-950 antialiased">
    <div class="max-w-screen-xl mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-12 dark:text-gray-200">Latest Recipe</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 items-center">
            <div>
                <img src="{{ $latestRecipe->r_image }}" alt="{{ $latestRecipe->r_title_id }}" class="rounded-lg shadow-lg w-full h-auto">
            </div>
            <div class="dark:text-gray-200">
                <h3 class="text-3xl font-bold mb-4">{{ $latestRecipe->r_title_id }}</h3>
                <p class="text-sm text-custom-green mb-4">{{ $latestRecipe->category_name }}</p>
                <a href="/recipes/{{ $latestRecipe->r_id }}" class="inline-block bg-custom-lightgreen hover:bg-custom-green text-white dark:text-gray-200 font-bold py-3 px-8 rounded-lg transition duration-300">
                    LIHAT RESEP
                </a>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection