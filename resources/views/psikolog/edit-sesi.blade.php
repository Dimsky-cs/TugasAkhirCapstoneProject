<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Sesi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 class="text-xl font-bold mb-4">Update Status Konseling</h2>

                    <!-- Detail Pasien Singkat -->
                    <div class="bg-gray-50 p-4 rounded mb-6 border text-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600">Klien:</p>
                                <p class="font-semibold">{{ $konseling->client_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Jadwal:</p>
                                <p class="font-semibold">
                                    {{ \Carbon\Carbon::parse($konseling->consultation_date)->format('d M Y') }}
                                    <span class="text-gray-400">|</span>
                                    {{ $konseling->consultation_time }}
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-gray-600">Keluhan Awal:</p>
                                <p class="italic text-gray-800">"{{ $konseling->description ?? '-' }}"</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('psikolog.sesi.update', $konseling->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Status Dropdown -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                                Status Terkini
                            </label>
                            <select name="status" id="status"
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                onchange="toggleInputs()">
                                <option value="pending" {{ $konseling->status == 'pending' ? 'selected' : '' }}>Pending
                                    (Menunggu Konfirmasi)</option>
                                <option value="confirmed" {{ $konseling->status == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed (Terima Jadwal)</option>
                                <option value="completed" {{ $konseling->status == 'completed' ? 'selected' : '' }}>
                                    Completed (Selesai)</option>
                                <option value="cancelled" {{ $konseling->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled (Batalkan)</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Input Link Meeting (Muncul jika Confirmed) -->
                        <div id="link-container" class="mb-4 {{ $konseling->status == 'confirmed' ? '' : 'hidden' }}">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="meeting_link">
                                Link Meeting (Google Meet / Zoom) <span class="text-red-500">*</span>
                            </label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    🔗
                                </span>
                                <input type="url" name="meeting_link" id="meeting_link"
                                    value="{{ old('meeting_link', $konseling->meeting_link) }}"
                                    class="shadow appearance-none border rounded-r w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="https://meet.google.com/xxx-xxx-xxx">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Link wajib diisi agar tombol 'Gabung' muncul di
                                dashboard klien.</p>
                            @error('meeting_link')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Input Catatan (Muncul jika Completed) -->
                        <div id="notes-container" class="mb-4 {{ $konseling->status == 'completed' ? '' : 'hidden' }}">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="psikolog_notes">
                                Catatan Konseling (Opsional)
                            </label>
                            <textarea name="psikolog_notes" id="psikolog_notes" rows="4"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Tulis ringkasan sesi, diagnosa awal, atau saran untuk klien...">{{ old('psikolog_notes', $konseling->psikolog_notes) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Catatan ini akan bisa dilihat oleh klien di riwayat
                                mereka.</p>
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-4">
                            <a href="{{ route('psikolog.dashboard') }}"
                                class="text-gray-600 mr-4 hover:underline text-sm">Kembali</a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleInputs() {
            const status = document.getElementById('status').value;
            const linkContainer = document.getElementById('link-container');
            const notesContainer = document.getElementById('notes-container');

            // Reset tampilan
            linkContainer.classList.add('hidden');
            notesContainer.classList.add('hidden');

            // Logika Tampilan
            if (status === 'confirmed') {
                linkContainer.classList.remove('hidden');
            } else if (status === 'completed') {
                notesContainer.classList.remove('hidden');
            }
        }

        // Jalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            toggleInputs();
        });
    </script>
</x-app-layout>
