<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Edit Jadwal Konseling</h2>
                        <p class="text-gray-500 mb-6">Perbarui detail untuk jadwal konseling ini.</p>

                        <!-- Form Edit -->
                        <form action="{{ route('admin.konseling.update', $konseling->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Nama Klien (Read Only - Biar Aman) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Klien</label>
                                    <input type="text" value="{{ $konseling->client_name }}" readonly
                                        class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm text-gray-500 cursor-not-allowed">
                                    <!-- Hidden Input User ID -->
                                    <input type="hidden" name="user_id" value="{{ $konseling->user_id }}">
                                    <input type="hidden" name="client_name" value="{{ $konseling->client_name }}">
                                </div>

                                <!-- Email Klien (Read Only) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Klien</label>
                                    <input type="text" name="client_email" value="{{ $konseling->client_email }}"
                                        readonly
                                        class="w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm text-gray-500 cursor-not-allowed">
                                </div>

                                <!-- No. Telepon -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                    <input type="text" name="client_phone"
                                        value="{{ old('client_phone', $konseling->client_phone) }}" required
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <!-- Jenis Layanan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Layanan</label>
                                    <select name="service_type"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach (['Kecemasan', 'Karier', 'Hubungan', 'Stres', 'Depresi'] as $service)
                                            <option value="{{ $service }}"
                                                {{ old('service_type', $konseling->service_type) == $service ? 'selected' : '' }}>
                                                {{ $service }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Preferensi Sesi -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Preferensi Sesi</label>
                                    <select name="session_preference"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach (['Video Call', 'Voice Call', 'Chat Saja'] as $pref)
                                            <option value="{{ $pref }}"
                                                {{ old('session_preference', $konseling->session_preference) == $pref ? 'selected' : '' }}>
                                                {{ $pref }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Psikolog (Dropdown) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Psikolog
                                        (Opsional)</label>
                                    <select name="psikolog_id"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">-- Belum Ditugaskan --</option>
                                        @foreach ($psikologs as $p)
                                            <option value="{{ $p->id }}"
                                                {{ old('psikolog_id', $konseling->psikolog_id) == $p->id ? 'selected' : '' }}>
                                                {{ $p->name }}
                                                ({{ is_array($p->specialties) ? implode(', ', $p->specialties) : 'Umum' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tanggal Konseling -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                        Konseling</label>
                                    <input type="date" name="consultation_date"
                                        value="{{ old('consultation_date', $konseling->consultation_date) }}" required
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>

                                <!-- Waktu Konseling (INI YANG KITA PERBAIKI) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Konseling</label>
                                    <select name="consultation_time" required
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @php
                                            // Mengambil jam dari database, formatnya mungkin "11:00:00", kita ambil "11:00"
                                            $currentVal = \Carbon\Carbon::parse($konseling->consultation_time)->format(
                                                'H:i',
                                            );
                                            // Prioritaskan input lama jika validasi gagal (old), kalau tidak ada pakai data DB
                                            $selectedValue = old('consultation_time', $currentVal);
                                        @endphp

                                        @foreach (['09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00', '19:00', '20:00'] as $time)
                                            <option value="{{ $time }}"
                                                {{ $selectedValue == $time ? 'selected' : '' }}>
                                                {{ $time }} WIB
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach (['pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('status', $konseling->status) == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <!-- Deskripsi (Full Width) -->
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi / Keluhan
                                    (Opsional)</label>
                                <textarea name="description" rows="3"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $konseling->description) }}</textarea>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="flex items-center justify-end mt-8 space-x-4">
                                <a href="{{ route('admin.konseling.index') }}"
                                    class="text-gray-600 hover:text-gray-900 font-medium">Batal</a>
                                <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-150">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
