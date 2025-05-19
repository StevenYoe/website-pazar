@extends('master')

@section('title', 'Info Karir - Pazar Seasonings')

<!-- Career Info Header Section -->
@section('header')
<div class="not-index landing-content max-w-screen-xl mx-auto px-4 py-20">
    <div class="flex flex-col items-center text-center">
        <div class="text-white mb-8">
            <p class="text-xl mb-2 text-yellow-400 dark:text-yellow-400">Karir</p>
            <h1 class="text-5xl font-bold dark:text-gray-200">Info Karir</h1>
        </div>
        <div class="w-full max-w-4xl">
            <img src="img/Web/career.jpg" alt="Career-Overview" class="rounded-lg shadow-lg w-full">
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Bekerja di Pazar Section -->
<section class="py-16 bg-white dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-6 dark:text-gray-200">Bekerja di Pazar</h2>
            <div class="max-w-4xl mx-auto text-lg leading-relaxed text-gray-600 dark:text-gray-300 space-y-6">
                <p>
                    Pazar adalah perusahaan manufaktur bumbu masakan terkemuka yang telah dipercaya oleh ribuan keluarga Indonesia selama bertahun-tahun. Sebagai bagian dari keluarga besar Pazar, Anda akan berkontribusi dalam menyajikan cita rasa autentik yang memperkaya kuliner nusantara.
                </p>
                <p>
                    Dengan fasilitas produksi modern dan teknologi terdepan, kami berkomitmen untuk menghasilkan produk bumbu berkualitas tinggi yang memenuhi standar internasional. Di Pazar, setiap karyawan memiliki peran penting dalam menjaga kualitas dan kelezatan setiap produk yang sampai ke tangan konsumen.
                </p>
                <p>
                    Kami mencari individu yang passionate, inovatif, dan siap berkembang bersama perusahaan. Bergabunglah dengan tim profesional kami dan rasakan pengalaman bekerja di lingkungan yang mendukung kreativitas, pembelajaran berkelanjutan, dan pencapaian career goals yang optimal.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Kelebihan Pazar Section -->
<section class="py-16 bg-gray-50 dark:bg-gray-950 antialiased">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-center mb-16 dark:text-gray-200">Mengapa Memilih Berkarir di Pazar?</h2>
        
        <!-- First Feature -->
        <div class="grid md:grid-cols-2 gap-12 items-center mb-20">
            <div>
                <h3 class="text-3xl font-bold mb-6 text-custom-green dark:text-custom-lightgreen">Memberikan Dampak Positif</h3>
                <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                    Kami percaya pada kekuatan kebaikan untuk meningkatkan kualitas hidup. Keyakinan ini mendorong komitmen kami untuk menggunakan skala global, sumber daya dan keahlian untuk berkontribusi pada masa depan yang lebih sehat bagi masyarakat dan planet. Anda akan bergabung dengan perusahaan yang berkomitmen membuat dampak positif melalui cita rasa autentik Indonesia.
                </p>
            </div>
            <div>
                <img src="img/Web/make-impact.jpg" alt="Memberikan Dampak Positif di Pazar" class="rounded-lg shadow-lg w-full h-auto">
            </div>
        </div>

        <!-- Second Feature -->
        <div class="grid md:grid-cols-2 gap-12 items-center mb-20">
            <div class="order-2 md:order-1">
                <img src="img/Web/make-impact.jpg" alt="Budaya Inovasi" class="rounded-lg shadow-lg w-full h-auto">
            </div>
            <div class="order-1 md:order-2">
                <h3 class="text-3xl font-bold mb-6 text-custom-green dark:text-custom-lightgreen">Budaya Inovasi</h3>
                <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                    Di Pazar, inovasi adalah inti dari semua yang kami lakukan. Dari teknik tradisional pencampuran bumbu hingga proses manufaktur modern, kami mendorong tim untuk berpikir kreatif dan melampaui batas. Bergabunglah dengan tempat kerja di mana ide-ide Anda dihargai dan inovasi mendorong kesuksesan kami dalam menghadirkan produk luar biasa untuk keluarga Indonesia.
                </p>
            </div>
        </div>

        <!-- Third Feature -->
        <div class="grid md:grid-cols-2 gap-12 items-center mb-20">
            <div>
                <h3 class="text-3xl font-bold mb-6 text-custom-green dark:text-custom-lightgreen">Pertumbuhan Profesional</h3>
                <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                    Perjalanan karir Anda sangat berarti bagi kami. Kami menyediakan program pelatihan komprehensif, kesempatan mentoring, dan jalur perkembangan karir yang jelas. Baik Anda yang baru memulai karir atau ingin naik ke level berikutnya, Pazar menawarkan dukungan dan sumber daya yang dibutuhkan untuk mencapai aspirasi profesional Anda di industri manufaktur makanan.
                </p>
            </div>
            <div>
                <img src="img/Web/make-impact.jpg" alt="Pertumbuhan Profesional" class="rounded-lg shadow-lg w-full h-auto">
            </div>
        </div>

        <!-- Fourth Feature -->
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1">
                <img src="img/Web/make-impact.jpg" alt="Kolaborasi Tim" class="rounded-lg shadow-lg w-full h-auto">
            </div>
            <div class="order-1 md:order-2">
                <h3 class="text-3xl font-bold mb-6 text-custom-green dark:text-custom-lightgreen">Lingkungan Kolaboratif</h3>
                <p class="text-lg leading-relaxed text-gray-600 dark:text-gray-300">
                    Rasakan kekuatan kerja tim dalam lingkungan kerja yang inklusif dan kolaboratif. Di Pazar, perspektif yang beragam dihargai, dan setiap anggota tim berkontribusi pada kesuksesan bersama. Bangun hubungan bermakna dengan rekan kerja yang berbagi passion Anda untuk kualitas dan keunggulan dalam manufaktur bumbu.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-custom-green dark:bg-custom-green">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">Siap Bergabung dengan Tim Pazar?</h2>
        <p class="text-xl text-white mb-8 max-w-3xl mx-auto">
            Jelajahi berbagai posisi karir yang tersedia dan temukan peluang yang sesuai dengan passion dan keahlian Anda. Mari bersama-sama menciptakan cita rasa yang menginspirasi.
        </p>
        <a href="/vacancies" class="inline-block bg-white hover:bg-gray-100 text-custom-green font-bold py-4 px-8 rounded-lg transition duration-300 text-lg">
            LIHAT LOWONGAN KERJA
        </a>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/back-to-top.js') }}"></script>
@endsection