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
        <a href="https://shopee.co.id/pazar_seasonings">
            <img src="img/web/popup-banner1.jpg" alt="Pop Up Foto" 
                class="mx-auto rounded-lg transition-opacity duration-300 hover:opacity-75 max-h-[600px] max-w-[80%] w-auto" />
        </a>
        
        <!-- Tombol Close -->
        <button id="closeModal" class="mt-4 bg-gray-200 hover:bg-gray-300 rounded-full p-3 flex items-center justify-center">
            <svg aria-hidden="true" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

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
                    <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
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
                    <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
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
                    <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
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
                    <a href="/products" class="text-custom-green hover:text-custom-lightergreen font-medium text-sm self-end">SELENGKAPNYA →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certification Section -->
<section class="certification py-16 bg-gray-50 dark:bg-gray-950 antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 dark:text-gray-200">Sertifikasi Kami</h2>
        
        <div class="relative">
            <!-- Carousel container -->
            <div class="carousel-container overflow-hidden">
                <div class="carousel-track flex transition-transform duration-500" id="certificationTrack">
                    <!-- Certification Item 1 -->
                    <div class="certification-item min-w-full md:min-w-[50%] px-4">
                        <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-row items-center h-full">
                            <div class="w-full md:w-1/3 mb-6 md:mb-0">
                                <img src="img/web/halal-certification.jpg" alt="Sertifikasi Halal" class="rounded-lg mx-auto max-h-48">
                            </div>
                            <div class="w-full md:w-2/3 md:pl-6">
                                <div class="mb-4">
                                    <span class="bg-custom-lightergreen text-white px-3 py-1 rounded-full text-sm font-medium dark:text-gray-200">Halal</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Sertifikat Halal MUI</h3>
                                <p class="text-gray-600 dark:text-gray-800 mb-4">Produk kami telah tersertifikasi halal oleh Majelis Ulama Indonesia yang menjamin kehalalan produk sesuai dengan syariat Islam.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Certification Item 2 -->
                    <div class="certification-item min-w-full md:min-w-[50%] px-4">
                        <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-row items-center h-full">
                            <div class="w-full md:w-1/3 mb-6 md:mb-0">
                                <img src="img/web/haccp-certification.jpg" alt="Sertifikasi HACCP" class="rounded-lg mx-auto max-h-48">
                            </div>
                            <div class="w-full md:w-2/3 md:pl-6">
                                <div class="mb-4">
                                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium dark:text-gray-200">Keamanan Pangan</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Sertifikat HACCP</h3>
                                <p class="text-gray-600 dark:text-gray-800 mb-4">Sistem manajemen keamanan pangan kami telah memenuhi standar Hazard Analysis and Critical Control Points (HACCP).</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Certification Item 3 -->
                    <div class="certification-item min-w-full md:min-w-[50%] px-4">
                        <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-row items-center h-full">
                            <div class="w-full md:w-1/3 mb-6 md:mb-0">
                                <img src="img/web/iso-certification.jpg" alt="Sertifikasi ISO" class="rounded-lg mx-auto max-h-48">
                            </div>
                            <div class="w-full md:w-2/3 md:pl-6">
                                <div class="mb-4">
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium dark:text-gray-200">Standar Internasional</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Sertifikat ISO 22000</h3>
                                <p class="text-gray-600 dark:text-gray-800 mb-4">Produk kami telah memenuhi standar internasional ISO 22000 untuk sistem manajemen keamanan pangan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation buttons -->
            <button class="carousel-nav carousel-prev absolute top-1/2 left-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10 hidden md:block" aria-label="Previous slide">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-custom-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="carousel-nav carousel-next absolute top-1/2 right-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10 hidden md:block" aria-label="Next slide">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-custom-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <!-- Carousel indicators -->
            <div class="carousel-indicators flex justify-center mt-8 space-x-2">
                <button class="w-3 h-3 rounded-full bg-custom-green" data-index="0" aria-label="Go to slide 1"></button>
                <button class="w-3 h-3 rounded-full bg-gray-300" data-index="1" aria-label="Go to slide 2"></button>
                <button class="w-3 h-3 rounded-full bg-gray-300" data-index="2" aria-label="Go to slide 3"></button>
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