<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- BAGIAN KIRI: Gambar & Quote (Hanya di Desktop) --}}
        <div class="lg:w-1/2 w-full bg-cover bg-center hidden lg:block relative"
            style="background-image: url('{{ asset('images/auth-bg-register-full.jpg') }}');">

            {{-- Overlay Gelap --}}
            <div class="absolute inset-0 bg-sage bg-opacity-40"></div>

            {{-- Teks Tengah Gambar --}}
            <div class="absolute inset-0 flex flex-col justify-center items-center text-center p-12 z-10">
                <h2 class="text-4xl font-bold text-white mb-4 drop-shadow-lg">
                    Kembali Pulih.
                </h2>
                <p class="text-lg text-gray-100 drop-shadow-md">
                    Kami siap membantu mengamankan akun Anda kembali.
                </p>
            </div>
        </div>

        {{-- BAGIAN KANAN: Form Reset Password --}}
        <div class="lg:w-1/2 w-full flex flex-col justify-center items-center p-8 bg-white">

            <div class="w-full max-w-md">

                {{-- Header Mobile (Kembali) --}}
                <div class="block lg:hidden mb-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-pink-600 transition">
                        ← Kembali
                    </a>
                </div>

                {{-- Judul & Deskripsi --}}
                <div class="text-center mb-8">
                    <div class="mx-auto w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Lupa Password?</h2>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Jangan khawatir. Masukkan alamat email yang Anda gunakan saat mendaftar, dan kami akan
                        mengirimkan link untuk mereset password Anda.
                    </p>
                </div>

                <!-- Status Session (Pesan Sukses) -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Input Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-pink-500 focus:ring focus:ring-pink-200 transition duration-200 placeholder-gray-400"
                            placeholder="Contoh: nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Tombol Kirim -->
                    <button type="submit" style="background-color: #db2777; color: white;"
                        class="w-full py-3 px-4 rounded-xl font-bold shadow-md hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-200">
                        Kirim Link Reset Password
                    </button>

                    <!-- Link Kembali -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Ingat password Anda?
                            <a href="{{ route('login') }}" class="font-bold text-pink-600 hover:underline">
                                Masuk disini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
