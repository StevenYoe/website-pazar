@extends('master')

<!-- History Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">Tentang Pazar Seasoning</p>
            <h1 class="text-5xl font-bold dark:text-gray-200">Sejarah Pazar Seasoning</h1>
        </div>
        <div class="w-full max-w-4xl">
            <img src="img/Web/history.jpg" alt="History-Overview" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Product Category Section -->
<section class="product-category py-10 bg-white dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl mx-auto px-20">
        <h2 class="text-4xl font-bold text-center mb-12 dark:text-gray-200">Our Product Categories</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4">
            <!-- Bumbu Instan Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/bumbu-instan.jpg" alt="Bumbu Instan" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold mb-2">Bumbu Instan</h3>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Bumbu instan berkualitas tinggi untuk membuat masakan rumah dengan rasa autentik</p>
                    <a href="Product.html" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
            
            <!-- Sambal Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/sambal.jpg" alt="Sambal" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold mb-2">Sambal</h3>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Sambal dengan cita rasa pedas yang khas untuk pelengkap hidangan favorit</p>
                    <a href="Product.html" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
            
            <!-- Rempah Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/rempah.jpg" alt="Rempah" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold mb-2">Rempah</h3>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Rempah pilihan berkualitas untuk meningkatkan aroma dan cita rasa masakan</p>
                    <a href="Product.html" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
            
            <!-- Produk Spesial Card -->
            <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/produk-spesial.jpg" alt="Produk Spesial" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold mb-2">Produk Spesial</h3>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Tepung bumbu praktis untuk gorengan renyah dan gurih dalam sekejap</p>
                    <a href="Product.html" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection