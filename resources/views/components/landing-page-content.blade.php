{{--
File "Master" Landing Page
--}}

{{-- BAGIAN HOME (HERO SECTION) --}}
<section id="home"
    class="min-h-screen scroll-mt-16 flex items-center justify-center relative bg-gradient-to-br from-green-50 via-white to-pink-50">
    <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 text-center z-10">

        @auth
            {{-- Tampilan untuk USER LOGIN --}}
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800 leading-tight tracking-tight">
                Selamat Datang, <span class="text-pink-500">{{ Auth::user()->name }}</span>!
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Jelajahi layanan kami dan temukan dukungan yang Kamu butuhkan untuk perjalanan kesehatan mental Kamu.
            </p>
            <div class="mt-10">
                <a href="{{ route('user.konseling.create') }}"
                    class="inline-block bg-green-500 text-white font-bold text-lg px-8 py-4 rounded-full hover:bg-green-600 transition-transform transform hover:scale-105 shadow-lg">
                    Mulai Konseling Sekarang
                </a>
            </div>
        @else
            {{-- Tampilan untuk GUEST --}}
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800 leading-tight tracking-tight">
                <div class="inline-block align-middle">Lagi <span class="text-pink-500 rotating-text-wrapper">
                        <span class="rotating-text-item">Cemas?</span>
                        <span class="rotating-text-item">Stres?</span>
                        <span class="rotating-text-item">Overthinking?</span>
                        <span class="rotating-text-item">Bingung?</span>
                    </span></div><br />
                Temukan Solusinya di Sini
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Layanan konseling profesional untuk membantu Kamu melewati setiap tantangan hidup dengan percaya diri.
            </p>
            <div class="mt-10">
                <a href="#layanan"
                    class="inline-block bg-green-500 text-white font-bold text-lg px-8 py-4 rounded-full hover:bg-green-600 transition-transform transform hover:scale-105 shadow-lg">
                    Lihat Layanan Kami
                </a>
            </div>
        @endauth
    </div>
</section>

{{-- [PERUBAHAN BESAR DI SINI] --}}
<section id="tentang" class="py-20 bg-white scroll-mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- 1. Paragraf "Tentang" Dibuat Lebih Jelas --}}
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800">Tentang <span class="text-pink-500">Gen-Z</span> Psychology
            </h2>
            <p class="text-lg text-gray-600 mt-6 leading-relaxed">
                Gen-Z Psychology lahir dari sebuah keresahan: membicarakan kesehatan mental seringkali masih terasa
                sulit, tabu, atau diabaikan. Kami percaya bahwa merasa cemas, burnout, atau bingung adalah hal yang
                valid dan manusiawi.
            </p>
            <p class="text-lg text-gray-600 mt-4 leading-relaxed">
                Misi kami adalah menyediakan ruang aman yang profesional, mudah diakses, dan non-judgmental (tidak
                menghakimi) bagi siapa saja terutama kamu untuk bertumbuh, pulih, dan lebih memahami diri sendiri.
            </p>
        </div>

        {{-- 2. Cerita Founder (Revisi Total) --}}
        <div class="mt-20 max-w-4xl mx-auto">
            <h3 class="text-3xl font-bold text-center mb-6 text-green-500">Cerita di Balik Layar</h3>
            <p class="text-center text-gray-600 max-w-3xl mx-auto mb-12 text-lg">
                Platform ini didirikan oleh Dimas Smeichel Maliseono (CEO) dan Alfian Nurshanbani(Co-Founder).
                Berawal dari keresahan bersama melihat banyaknya teman sebaya yang kesulitan menemukan dukungan
                kesehatan mental yang relate dan terjangkau, mereka menggabungkan keahlian di bidang psikologi dan
                teknologi untuk membangun Gen-Z Psychology.
            </p>

            {{-- 3. Grid diubah jadi 2 kolom & dihapus 2 orang --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-start">

                <!-- Tim Anggota 1 (Dimas) -->
                <div class="text-center p-4">
                    <img class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg transform hover:scale-110 transition-transform object-cover"
                        src="{{ asset('dimas.png') }}" alt="Foto Dimas Smeichel Maliseono">
                    <h4 class="text-xl font-bold text-gray-800">Dimas Smeichel Maliseono</h4>
                    <p class="text-gray-500 font-semibold">Founder, CEO & Psikolog</p>
                    {{-- Paragraf personal dihapus --}}
                </div>

                <!-- Tim Anggota 2 (Pascalis) -->
                <div class="text-center p-4">
                    <img class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg transform hover:scale-110 transition-transform object-cover"
                        src="{{ asset('alfian.jpg') }}" alt="Foto Alfian Nurshabani">
                    <h4 class="text-xl font-bold text-gray-800">Alfian Nurshabani</h4>
                    <p class="text-gray-500 font-semibold">Co-Founder, Head of Product & Psikolog</p>
                    {{-- Paragraf personal dihapus --}}
                </div>
            </div>
        </div>
    </div>
</section>
{{-- [AKHIR PERUBAHAN] --}}

{{-- [PERUBAHAN BAHASA & IKON DI SINI] --}}
<section id="layanan" class="py-20 bg-gradient-to-br from-pink-50 via-white to-green-50 scroll-mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- [BAGIAN BARU] Penjelasan "Ngapain Aja Sih?" -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800">Gimana Sesi Konseling di Sini?</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4 text-lg">
                Baru pertama kali? Tenang, ini bukan ujian. Sesi kami 100% rahasia, tidak menghakimi, dan tujuannya
                untuk membantu Kamu merasa lebih baik.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20 max-w-5xl mx-auto">
            <!-- Step 1 Card -->
            <div class="how-it-works-card">
                {{-- [IKON DIKEMBALIKAN] --}}
                <svg class="how-it-works-card-icon text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.525 9.525a.75.75 0 00-1.06 1.061M16.06 16.061a.75.75 0 001.06-1.06M9.525 14.475a.75.75 0 011.06 1.06M14.475 9.525a.75.75 0 011.06 1.06M16.06 7.939a.75.75 0 00-1.06-1.06M7.939 16.061a.75.75 0 00-1.06-1.06M12 9a.75.75 0 01.75.75v.008a.75.75 0 01-1.5 0V9.75A.75.75 0 0112 9z" />
                </svg>
                <h3 class="how-it-works-card-title">1. Bercerita (Zona Aman)</h3>
                <p class="how-it-works-card-text">
                    Kamu bisa ceritakan apa saja yang sedang Kamu rasakan. Psikolog kami hadir untuk mendengarkan,
                    memahami, dan mencari tahu dari sudut pandang Kamu.
                </p>
            </div>
            <!-- Step 2 Card -->
            <div class="how-it-works-card">
                {{-- [IKON DIKEMBALIKAN] --}}
                <svg class="how-it-works-card-icon text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0011.667 0l3.181-3.183m-4.991-1.328a8.25 8.25 0 01-11.667 0M12 17.25a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                <h3 class="how-it-works-card-title">2. Temukan Pola</h3>
                <p class="how-it-works-card-text">
                    Bersama psikolog, Kamu akan dibantu memetakan masalah, mencari tahu pola pikir atau pemicu, dan
                    menemukan akar dari apa yang Kamu rasakan.
                </p>
            </div>
            <!-- Step 3 Card -->
            <div class="how-it-works-card">
                {{-- [IKON DIKEMBALIKAN] --}}
                <svg class="how-it-works-card-icon text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18.375a6.375 6.375 0 100-12.75 6.375 6.375 0 000 12.75zM12 12.75A2.625 2.625 0 1012 7.5a2.625 2.625 0 000 5.25z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.375V12m0 6.375V12m0-6.375V12" />
                </svg>
                <h3 class="how-it-works-card-title">3. Dapatkan Solusi Praktis</h3>
                <p class="how-it-works-card-text">
                    kamu tidak hanya bercerita. Kamu akan pulang dengan strategi dan cara-cara baru yang praktis untuk
                    menghadapi tantangan di masa depan.
                </p>
            </div>
        </div>
        <!-- [AKHIR BAGIAN BARU] -->


        <!-- [BAGIAN LAMA - Ganti Judul & Teks] -->
        <h2 class="text-4xl font-bold text-center mb-12">Topik yang Sering Dibahas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Kartu 1: Konseling Karier -->
            <div class="service-card">
                <div class="mx-auto mb-6 bg-green-100 p-4 rounded-full">
                    {{-- [IKON DIKEMBALIKAN] --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h5 class="text-2xl font-bold mb-2">Konseling Karier</h5>
                <p class="text-gray-600 flex-grow">Merasa stuck di karier? Bingung menentukan arah? Atau merasa
                    *burnout* dengan pekerjaan? Mari kita cari solusinya.</p>
            </div>

            <!-- Kartu 2: Konseling Stres -->
            <div class="service-card">
                <div class="mx-auto mb-6 bg-pink-100 p-4 rounded-full">
                    {{-- [IKON DIKEMBALIKAN] --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <h5 class="text-2xl font-bold mb-2">Konseling Stres</h5>
                <p class="text-gray-600 flex-grow">Merasa overwhelmed dengan tuntutan hidup, kuliah, atau pekerjaan?
                    Kita akan belajar teknik mengelola stres agar lebih tenang.</p>
            </div>

            <!-- Kartu 3: Konseling Hubungan -->
            <div class="service-card">
                <div class="mx-auto mb-6 bg-pink-100 p-4 rounded-full">
                    {{-- [IKON DIKEMBALIKAN] --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h5 class="text-2xl font-bold mb-2">Konseling Hubungan</h5>
                <p class="text-gray-600 flex-grow">Punya masalah dengan pasangan, keluarga, atau teman? Mari belajar
                    membangun komunikasi sehat dan relasi yang lebih baik.</p>
            </div>

            <!-- Kartu 4: Konseling Kecemasan -->
            <div class="service-card">
                <div class="mx-auto mb-6 bg-green-100 p-4 rounded-full">
                    {{-- [IKON DIKEMBALIKAN] --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h5 class="text-2xl font-bold mb-2">Konseling Kecemasan</h5>
                <p class="text-gray-600 flex-grow">Sering overthinking atau cemas berlebihan akan sesuatu? Kita akan
                    cari cara praktis agar kecemasan tidak mengendalikan hidup Kamu.</p>
            </div>
        </div>

        <div class="text-center mt-16">
            @auth
                @if (Auth::user()->role == 'user')
                    <a href="{{ route('user.konseling.create') }}"
                        class="inline-block bg-pink-500 text-white font-bold text-lg px-10 py-4 rounded-full hover:bg-pink-600 transition shadow-lg hover:shadow-xl">
                        Mulai Konseling Sekarang
                    </a>
                @endif
            @else
                <a href="{{ route('register') }}"
                    class="inline-block bg-pink-500 text-white font-bold text-lg px-10 py-4 rounded-full hover:bg-pink-600 transition shadow-lg hover:shadow-xl">
                    Mulai Konseling Sekarang
                </a>
            @endauth
        </div>
    </div>
</section>

{{-- BAGIAN KONTAK --}}
<section id="kontak" class="py-20 bg-white scroll-mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl font-bold text-gray-800">Hubungi Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Punya pertanyaan? Kami siap membantu.</p>
        </div>

        <!-- Kartu Visual Kontak -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-16 max-w-4xl mx-auto">
            <!-- Kartu Email -->
            <a href="mailto:info@psikologionline.com" class="contact-visual-card">
                <div class="flex-shrink-0 bg-pink-100 p-4 rounded-2xl">
                    {{-- [IKON DIKEMBALIKAN] --}}
                    <svg class="h-8 w-8 text-pink-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-semibold text-gray-900">Email Kami</h3>
                    <p class="text-gray-600">info@psikologionline.com</p>
                </div>
            </a>
            <!-- Kartu WhatsApp -->
            <a href="https://wa.me/6281234567890" target="_blank" class="contact-visual-card">
                <div class="flex-shrink-0 bg-green-100 p-4 rounded-2xl">
                    {{-- [IKON DIKEMBALIKAN - Pakai ikon Telepon] --}}
                    <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-semibold text-gray-900">WhatsApp Kami</h3>
                    <p class="text-gray-600">+62 812-3456-7890</p>
                </div>
            </a>
        </div>

        <!-- Simulasi Feed Instagram -->
        <div class="mt-20 max-w-5xl mx-auto">
            <h3 class="text-3xl font-bold text-center text-gray-800 mb-8">Ikuti Perjalanan Kami</h3>
            <div class="ig-grid">
                <!-- Gunakan gambar placeholder. Ganti 'text' dengan tema -->
                <div class="ig-post group">
                    <img src="https://placehold.co/400x400/FADBEA/333?text=Kesehatan+Mental" alt="IG Post 1"
                        loading="lazy">
                    <div class="ig-post-overlay">
                        <svg class="ig-post-overlay-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ig-post group">
                    <img src="https://placehold.co/400x400/D1FAE5/333?text=Self+Care" alt="IG Post 2" loading="lazy">
                    <div class="ig-post-overlay">
                        <svg class="ig-post-overlay-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ig-post group">
                    <img src="https://placehold.co/400x400/FADBEA/333?text=Quotes" alt="IG Post 3" loading="lazy">
                    <div class="ig-post-overlay">
                        <svg class="ig-post-overlay-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ig-post group">
                    <img src="https://placehold.co/400x400/D1FAE5/333?text=Tips+Cemas" alt="IG Post 4"
                        loading="lazy">
                    <div class="ig-post-overlay">
                        <svg class="ig-post-overlay-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ig-post group">
                    <img src="https://placehold.co/400x400/FADBEA/333?text=Event" alt="IG Post 5" loading="lazy">
                    <div class="ig-post-overlay">
                        <svg class="ig-post-overlay-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ig-post group">
                    <img src="https://placehold.co/400x400/D1FAE5/333?text=Q%26A" alt="IG Post 6" loading="lazy">
                    <div class="ig-post-overlay">
                        <svg class="ig-post-overlay-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="#" target="_blank"
                    class="inline-block bg-gray-800 text-white font-bold text-lg px-8 py-4 rounded-full hover:bg-gray-900 transition-colors shadow-lg">
                    Ikuti @genz.psychology di Instagram
                </a>
            </div>
        </div>
    </div>
</section>

{{-- BAGIAN FOOTER (Ini sama persis, tidak diubah) --}}
<footer class="bg-gray-800 text-gray-400 py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
        <p>&copy; 2025 Gen Z Psychology. All Rights Reserved.</p>
    </div>
</footer>

{{-- SCRIPT UNTUK HERO BERPUTAR --}}
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const wrapper = document.querySelector(".rotating-text-wrapper");
        if (wrapper) {
            const items = wrapper.querySelectorAll(".rotating-text-item");
            if (items.length > 0) {
                // Set tinggi wrapper sama dengan tinggi 1 item
                wrapper.style.height = items[0].clientHeight + 'px';
            }
        }
    });
</script>
