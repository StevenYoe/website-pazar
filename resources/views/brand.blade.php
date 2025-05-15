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
            <img src="img/Web/brand.jpg" alt="Company-Overview" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Why Pazar Section -->
<section class="why-pazar py-16 bg-white dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-12 dark:text-gray-200">Mengapa Pazar?</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @if(isset($whyPazarItems) && count($whyPazarItems) > 0)
                @foreach($whyPazarItems as $item)
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg shadow-sm p-6 flex flex-col h-full">
                        <div class="flex items-start mb-2">
                            <div class="flex-shrink-0 mr-2">
                                <img src="{{ $item->w_image }}" alt="{{ $item->w_title_id }}" class="w-10 h-10">
                            </div>
                            <h3 class="text-lg font-bold dark:text-gray-200 line-clamp-3">{{ $item->w_title_id }}</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">{{ $item->w_description_id }}</p>
                    </div>
                @endforeach
            @else
                <!-- Fallback items if no data is available -->
                @for($i = 0; $i < 5; $i++)
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg shadow-sm p-6 flex flex-col h-full">
                        <div class="flex items-start mb-4">
                            <div class="flex-shrink-0 mr-4">
                                <img src="img/Web/default-icon.svg" alt="Feature Icon" class="w-12 h-12">
                            </div>
                            <h3 class="text-lg font-bold dark:text-gray-200 line-clamp-2">Fitur Unggulan</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">Deskripsi mengenai keunggulan produk Pazar Seasoning.</p>
                    </div>
                @endfor
            @endif
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
                    @if(isset($certifications) && count($certifications) > 0)
                        @foreach($certifications as $certification)
                            <!-- Certification Item -->
                            <div class="certification-item min-w-full md:min-w-[50%] px-4">
                                <div class="bg-white dark:bg-gray-300 rounded-lg shadow-sm p-6 flex flex-row items-center h-full">
                                    <div class="w-full md:w-1/3 mb-6 md:mb-0">
                                        <img src="{{ $certification->c_image ?? 'img/Certification/default-certification.jpg' }}" alt="{{ $certification->c_title_id }}" class="rounded-lg mx-auto max-h-48">
                                    </div>
                                    <div class="w-full md:w-2/3 md:pl-6">
                                        <div class="mb-4">
                                            <span class="bg-custom-lightergreen text-white px-3 py-1 rounded-full text-sm font-medium dark:text-gray-200">{{ $certification->c_label_id }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold mb-2">{{ $certification->c_title_id }}</h3>
                                        <p class="text-gray-600 dark:text-gray-800 mb-4">{{ $certification->c_description_id }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
                @if(isset($certifications) && count($certifications) > 0)
                    @foreach($certifications as $index => $certification)
                        <button class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-custom-green' : 'bg-gray-300' }}" data-index="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}"></button>
                    @endforeach
                @else
                    <button class="w-3 h-3 rounded-full bg-custom-green" data-index="0" aria-label="Go to slide 1"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-300" data-index="1" aria-label="Go to slide 2"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-300" data-index="2" aria-label="Go to slide 3"></button>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="testimonials py-16 bg-white dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-8 dark:text-gray-200">Testimoni</h2>
        
        <div class="flex justify-center mb-8">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button type="button" id="customerTabBtn" class="testimonial-tab-active bg-custom-lightergreen dark:bg-transparent px-5 py-2 text-sm font-medium rounded-l-lg">
                    Customer
                </button>
                <button type="button" id="chefTabBtn" class="testimonial-tab-inactive bg-custom-lightergreen dark:bg-transparent px-5 py-2 text-sm font-medium rounded-r-lg">
                    Chef
                </button>
            </div>
        </div>
        
        <!-- Customer Testimonials -->
        <div id="customerTestimonials" class="testimonial-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($customerTestimonials) && count($customerTestimonials) > 0)
                    @foreach($customerTestimonials as $testimonial)
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg shadow-sm p-6">
                            <div class="flex items-center mb-4">
                                <div class="h-10 w-10 mr-4">
                                    @if($testimonial->t_profile)
                                        <img src="{{ $testimonial->t_profile }}" alt="{{ $testimonial->t_name }}" class="h-full w-full rounded-full object-cover">
                                    @elseif($testimonial->t_gender == 'Male')
                                        <img src="{{ asset('img/Testimonial/male-avatar.svg') }}" alt="{{ $testimonial->t_name }}" class="h-full w-full rounded-full object-cover">
                                    @elseif($testimonial->t_gender == 'Female')
                                        <img src="{{ asset('img/Testimonial/female-avatar.svg') }}" alt="{{ $testimonial->t_name }}" class="h-full w-full rounded-full object-cover">
                                    @else
                                        <img src="{{ asset('img/Testimonial/default-avatar.jpg') }}" alt="{{ $testimonial->t_name }}" class="h-full w-full rounded-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold dark:text-gray-200">{{ $testimonial->t_name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Customer</p>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300">{{ $testimonial->t_description_id }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
        <!-- Chef Testimonials - with alternating layout -->
        <div id="chefTestimonials" class="testimonial-content hidden">
            <div class="space-y-8">
                @if(isset($chefTestimonials) && count($chefTestimonials) > 0)
                    @foreach($chefTestimonials as $index => $testimonial)
                        @if($index % 2 == 0)
                        <!-- Odd chef testimonial - Image on left -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg shadow-sm p-6">
                            <div class="flex flex-col md:flex-row items-center">
                                <div class="md:w-1/3 mb-6 md:mb-0">
                                    <img src="{{ $testimonial->t_image ?? asset('img/Testimonial/default-chef.jpg') }}" alt="{{ $testimonial->t_name }}" class="rounded-lg mx-auto w-full max-w-xs object-cover">
                                </div>
                                <div class="md:w-2/3 md:pl-8">
                                    <h4 class="text-xl font-bold mb-4 dark:text-gray-200">{{ $testimonial->t_name }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $testimonial->t_description_id }}</p>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Even chef testimonial - Image on right -->
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg shadow-sm p-6">
                            <div class="flex flex-col md:flex-row-reverse items-center">
                                <div class="md:w-1/3 mb-6 md:mb-0">
                                    <img src="{{ $testimonial->t_image ?? asset('img/Testimonial/default-chef.jpg') }}" alt="{{ $testimonial->t_name }}" class="rounded-lg mx-auto w-full max-w-xs object-cover">
                                </div>
                                <div class="md:w-2/3 md:pr-8">
                                    <h4 class="text-xl font-bold mb-4 dark:text-gray-200">{{ $testimonial->t_name }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $testimonial->t_description_id }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
<script src="{{ asset('js/carousel.js') }}"></script>
@endsection