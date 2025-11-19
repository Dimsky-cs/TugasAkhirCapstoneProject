<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beri Ulasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h3 class="text-lg font-bold text-gray-800 mb-2">Bagaimana sesi Anda?</h3>
                    <p class="text-gray-600 mb-6">Berikan penilaian untuk Psikolog
                        <strong>{{ $konseling->psikolog->name }}</strong> pada sesi tanggal
                        {{ \Carbon\Carbon::parse($konseling->consultation_date)->format('d M Y') }}.</p>

                    <form action="{{ route('user.konseling.storeReview', $konseling->id) }}" method="POST">
                        @csrf

                        <!-- Rating Bintang -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Rating Bintang</label>
                            <div class="flex space-x-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}"
                                            class="hidden peer" required>
                                        <span
                                            class="text-3xl text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-300 transition duration-150">★</span>
                                        <div class="text-xs text-center text-gray-500 mt-1">{{ $i }}</div>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <span class="text-red-500 text-xs">Mohon pilih jumlah bintang.</span>
                            @enderror
                        </div>

                        <!-- Review Text -->
                        <div class="mb-6">
                            <label for="review" class="block text-gray-700 text-sm font-bold mb-2">Ulasan Anda</label>
                            <textarea name="review" id="review" rows="4"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Ceritakan pengalaman Anda... (Apakah membantu? Apakah psikolog ramah?)"></textarea>
                            @error('review')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('user.konseling.index') }}"
                                class="text-gray-500 mr-4 self-center hover:underline">Batal</a>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-150">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <style>
        /* Trik CSS sederhana agar bintang berubah warna saat dipilih */
        input[type="radio"]:checked+span {
            color: #FBBF24;
            /* Warna Kuning Tailwind */
        }
    </style>
</x-app-layout>
