<x-app-layout>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-8">Layanan Konseling</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Kartu 1: Konseling Karier -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h5 class="text-xl font-semibold mb-2">Konseling Karier</h5>
                        <p class="text-gray-600 flex-grow">Bimbingan arah karier dan pengembangan diri.</p>
                        {{-- <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-600 transition">Booking</a> --}}
                    </div>

                    <!-- Kartu 2: Konseling Stres -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <h5 class="text-xl font-semibold mb-2">Konseling Stres</h5>
                        <p class="text-gray-600 flex-grow">Mengelola stres dan tekanan dalam hidup.</p>
                        {{-- <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-600 transition">Booking</a> --}}
                    </div>

                    <!-- Kartu 3: Konseling Hubungan -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <h5 class="text-xl font-semibold mb-2">Konseling Hubungan</h5>
                        <p class="text-gray-600 flex-grow">Membantu menyelesaikan masalah relasi dan keluarga.</p>
                        {{-- <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-600 transition">Booking</a> --}}
                    </div>

                    <!-- Kartu 4: Konseling Kecemasan -->
                    <div class="bg-white rounded-lg shadow-md p-6 text-center flex flex-col">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <h5 class="text-xl font-semibold mb-2">Konseling Kecemasan</h5>
                        <p class="text-gray-600 flex-grow">Strategi mengatasi rasa cemas dan khawatir berlebih.</p>
                        {{-- <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-600 transition">Booking</a> --}}
                    </div>
                </div>

                {{-- TOMBOL MULAI KONSELING DIPINDAHKAN KE SINI --}}
                <div class="text-center mt-12">
                     @guest
                        <a href="{{ route('register') }}" class="inline-block bg-green-500 text-white font-bold text-lg px-8 py-3 rounded-lg hover:bg-green-600 transition">Mulai Konseling Sekarang</a>
                    @endguest
                </div></x-app-layout>
