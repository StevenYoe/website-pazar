@extends('master')

<!-- Hero/Header Section -->
@section('header')
<div class="landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="grid md:grid-cols-2 gap-8 items-center">
        <div class="text-white">
            <h1 class="text-5xl font-bold mb-6 dark:text-gray-200">Solusi Praktis Memasak</h1>
            <p class="text-xl mb-8 dark:text-gray-200">Kami memproduksi bumbu, kondimen, tepung bumbu, dan rempah yang berkualitas, halal, asli, aman, serta memenuhi standar keamanan pangan.</p>
            <a href="/history" class="inline-block bg-custom-lightgreen hover:bg-custom-green text-white dark:text-gray-200 font-bold py-3 px-8 rounded-lg transition duration-300">
                SELENGKAPNYA
            </a>
        </div>
        <div>
            <img src="img/Web/hero.jpeg" alt="Pazar Products" class="rounded-lg shadow-lg">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Pop-up Modal -->
<div id="popupModal" class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="relative bg-transparent rounded-lg shadow-lg max-w-2xl flex flex-col items-center">
        <!-- Container with relative positioning -->
        <div class="relative">
            <!-- Image Link -->
            <a href="https://shopee.co.id/pazar_seasonings">
                <img src="img/web/popup-banner1.jpg" alt="Pop Up Foto" 
                    class="mx-auto rounded-lg transition-opacity duration-300 hover:opacity-75 max-h-[600px] max-w-[80%] w-auto" />
            </a>
            
            <!-- Close Button - Positioned absolutely inside the top right corner of the image -->
            <button id="closeModal" class="absolute top-1 right-[calc(10%+3px)] bg-gray-200 hover:bg-gray-300 rounded-full p-2 flex items-center justify-center">
                <img src="img/Web/close.svg" class="w-5 h-5">
            </button>
        </div>
    </div>
</div>

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
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection