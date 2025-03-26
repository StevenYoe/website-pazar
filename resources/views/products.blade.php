@extends('master')

@section('style')
<link href="{{ asset('css/product.css') }}" rel="stylesheet" type="text/css" >

<!-- Product Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">Tentang Pazar Seasoning</p>
            <h1 class="text-5xl font-bold dark:text-gray-200">Produk Pazar Seasoning</h1>
        </div>
        <div class="w-full max-w-2xl">
            <img src="img/Web/hero.jpeg" alt="History-Overview" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Product Section -->
<section class="py-12 bg-gray-50 dark:bg-gray-950 antialiased dark:text-gray-200 product-section">
    <div class="max-w-screen-xl mx-auto px-20">
        <div class="filter-buttons">
            <button class="filter-btn bg-custom-lightergreen dark:bg-transparent active" data-filter="all">All</button>
            <button class="filter-btn bg-custom-lightergreen dark:bg-transparent" data-filter="Instant Seasoning">Bumbu Instan</button>
            <button class="filter-btn bg-custom-lightergreen dark:bg-transparent" data-filter="Sambal">Sambal</button>
            <button class="filter-btn bg-custom-lightergreen dark:bg-transparent" data-filter="Spices">Rempah</button>
            <button class="filter-btn bg-custom-lightergreen dark:bg-transparent" data-filter="Special Produk">Produk Spesial</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-4">
            <div class="product-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full" data-id="Bumbu-Instan-Ayam-Goyeng" data-category="Instant Seasoning">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/bumbu-instan.jpg" alt="Bumbu Instan Ayam Goyeng" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl text-black font-bold mb-1">Bumbu Instan Ayam Goyeng</h3>
                    <h4 class="text-sm text-custom-red font-bold mb-2">Bumbu Instan</h4>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Bumbu instan berkualitas tinggi untuk membuat masakan rumah dengan rasa autentik</p>
                    <a href="product/Bumbu-Instan-Ayam-Goyeng" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
            <div class="product-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full" data-id="Bumbu-Instan-Ayam-Buakar" data-category="Instant Seasoning">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/bumbu-instan.jpg" alt="Bumbu Instan Ayam Buakar" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl text-black font-bold mb-1">Bumbu Instan Ayam Buakar</h3>
                    <h4 class="text-sm text-custom-red font-bold mb-2">Bumbu Instan</h4>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Bumbu instan berkualitas tinggi untuk membuat masakan rumah dengan rasa autentik</p>
                    <a href="product/Bumbu-Instan-Ayam-Buakar" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
            <div class="product-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full" data-id="Sambal-Terasi" data-category="Sambal">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/sambal.jpg" alt="Sambal Terasi" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl text-black font-bold mb-1">Sambal Terasi</h3>
                    <h4 class="text-sm text-custom-red font-bold mb-2">Sambal</h4>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Sambal dengan cita rasa pedas yang khas untuk pelengkap hidangan favorit</p>
                    <a href="product/Sambal-Terasi" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
            <div class="product-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full" data-id="Lada-Hitam" data-category="Spices">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/rempah.jpg" alt="Lada Hitam" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl text-black font-bold mb-1">Lada Hitam</h3>
                    <h4 class="text-sm text-custom-red font-bold mb-2">Rempah</h4>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Rempah pilihan berkualitas untuk meningkatkan aroma dan cita rasa masakan</p>
                    <a href="product/Lada-Hitam" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
            <div class="product-item bg-white dark:bg-gray-300 rounded-lg shadow-sm flex flex-col h-full border border-gray-200 overflow-hidden max-w-xs mx-auto w-full" data-id="Bumbu-Instan-Edisi-Spesial" data-category="Special Produk">
                <div class="h-48 overflow-hidden">
                    <img src="img/Web/produk-spesial.jpg" alt="Bumbu Instan Edisi Spesial" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl text-black font-bold mb-1">Bumbu Instan Edisi Spesial</h3>
                    <h4 class="text-sm text-custom-red font-bold mb-2">Produk Spesial</h4>
                    <p class="text-gray-600 dark:text-gray-800 mb-4 flex-grow">Tepung bumbu praktis untuk gorengan renyah dan gurih dalam sekejap</p>
                    <a href="product/Bumbu-Instan-Edisi-Spesial" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/product.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection