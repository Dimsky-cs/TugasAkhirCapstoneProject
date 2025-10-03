<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Tambah Jadwal Konseling Baru</h2>
                <p class="text-gray-500 mb-8">Buat entri jadwal konseling baru secara manual.</p>

                <!-- Menampilkan Error Validasi -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('admin.konseling.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User (Klien) -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih Klien</label>
                            <select id="user_id" name="user_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option disabled selected value="">-- Pilih User --</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" data-email="{{ $user->email }}" data-name="{{ $user->name }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama Klien (terisi otomatis) -->
                        <div>
                            <label for="client_name" class="block text-sm font-medium text-gray-700">Nama Klien</label>
                            <input type="text" name="client_name" id="client_name" readonly class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100" value="{{ old('client_name') }}">
                        </div>

                        <!-- Email Klien (terisi otomatis) -->
                        <div>
                            <label for="client_email" class="block text-sm font-medium text-gray-700">Email Klien</label>
                            <input type="email" name="client_email" id="client_email" readonly class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-100" value="{{ old('client_email') }}">
                        </div>

                        <!-- Telepon -->
                         <div>
                            <label for="client_phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" name="client_phone" id="client_phone" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('client_phone') }}" placeholder="Contoh: 08123456789">
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="service_type" class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                            <select name="service_type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option @if(old('service_type') == 'Karier') selected @endif>Karier</option>
                                <option @if(old('service_type') == 'Stres') selected @endif>Stres</option>
                                <option @if(old('service_type') == 'Hubungan') selected @endif>Hubungan</option>
                                <option @if(old('service_type') == 'Kecemasan') selected @endif>Kecemasan</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                             <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="pending" @if(old('status') == 'pending') selected @endif>Pending</option>
                                <option value="confirmed" @if(old('status') == 'confirmed') selected @endif>Confirmed</option>
                                <option value="completed" @if(old('status') == 'completed') selected @endif>Completed</option>
                                <option value="cancelled" @if(old('status') == 'cancelled') selected @endif>Cancelled</option>
                            </select>
                        </div>

                         <!-- Tanggal -->
                        <div>
                            <label for="consultation_date" class="block text-sm font-medium text-gray-700">Tanggal Konseling</label>
                            <input type="date" name="consultation_date" id="consultation_date" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('consultation_date') }}">
                        </div>
                        
                        <!-- Waktu -->
                        <div>
                            <label for="consultation_time" class="block text-sm font-medium text-gray-700">Waktu Konseling</label>
                            <select name="consultation_time" id="consultation_time" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @for ($i = 9; $i <= 17; $i++)
                                    @php $time = sprintf('%02d', $i) . ':00:00'; @endphp
                                    <option value="{{ $time }}" @if(old('consultation_time') == $time) selected @endif>{{ sprintf('%02d', $i) }}:00</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.konseling.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Simpan Jadwal</button>
                    </div>
                </form>

                 <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const userSelect = document.getElementById('user_id');
                        const clientNameInput = document.getElementById('client_name');
                        const clientEmailInput = document.getElementById('client_email');

                        userSelect.addEventListener('change', function() {
                            const selectedOption = this.options[this.selectedIndex];
                            clientNameInput.value = selectedOption.dataset.name || '';
                            clientEmailInput.value = selectedOption.dataset.email || '';
                        });

                        // Trigger change on page load if a user is already selected (e.g., from old input)
                        if(userSelect.value) {
                            userSelect.dispatchEvent(new Event('change'));
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
