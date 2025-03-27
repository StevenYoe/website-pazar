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
            <img src="img/Web/close.svg" class="w-7 h-7">
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
                                <img src="img/Certification/halal-certification.jpg" alt="Sertifikasi Halal" class="rounded-lg mx-auto max-h-48">
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
                                <img src="img/Certification/haccp-certification.jpg" alt="Sertifikasi HACCP" class="rounded-lg mx-auto max-h-48">
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
                                <img src="img/Certification/iso-certification.jpg" alt="Sertifikasi ISO" class="rounded-lg mx-auto max-h-48">
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
                <img src="img/Web/left.svg" alt="left icon" class="h-6 w-6">
            </button>
            <button class="carousel-nav carousel-next absolute top-1/2 right-0 -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 focus:outline-none z-10 hidden md:block" aria-label="Next slide">
                <img src="img/Web/right.svg" alt="right icon" class="h-6 w-6">
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