<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit Jadwal Konseling</h2>
                <p class="text-gray-500 mb-8">Perbarui detail untuk jadwal konseling ini.</p>

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
                <form action="{{ route('admin.konseling.update', $konseling->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Klien -->
                        <div>
                            <label for="client_name" class="block text-sm font-medium text-gray-700">Nama Klien</label>
                            <input type="text" name="client_name" id="client_name" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('client_name', $konseling->client_name) }}">
                        </div>

                        <!-- Email Klien -->
                        <div>
                            <label for="client_email" class="block text-sm font-medium text-gray-700">Email Klien</label>
                            <input type="email" name="client_email" id="client_email" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('client_email', $konseling->client_email) }}">
                        </div>

                        <!-- Telepon -->
                         <div>
                            <label for="client_phone" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" name="client_phone" id="client_phone" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('client_phone', $konseling->client_phone) }}">
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="service_type" class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                            <select name="service_type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option @if(old('service_type', $konseling->service_type) == 'Karier') selected @endif>Karier</option>
                                <option @if(old('service_type', $konseling->service_type) == 'Stres') selected @endif>Stres</option>
                                <option @if(old('service_type', $konseling->service_type) == 'Hubungan') selected @endif>Hubungan</option>
                                <option @if(old('service_type', $konseling->service_type) == 'Kecemasan') selected @endif>Kecemasan</option>
                            </select>
                        </div>
                        
                        <!-- Tanggal -->
                        <div>
                            <label for="consultation_date" class="block text-sm font-medium text-gray-700">Tanggal Konseling</label>
                            <input type="date" name="consultation_date" id="consultation_date" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ old('consultation_date', $konseling->consultation_date) }}">
                        </div>
                        
                        <!-- Waktu -->
                        <div>
                            <label for="consultation_time" class="block text-sm font-medium text-gray-700">Waktu Konseling</label>
                             <select name="consultation_time" id="consultation_time" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @for ($i = 9; $i <= 17; $i++)
                                    @php $time = sprintf('%02d', $i) . ':00:00'; @endphp
                                    <option value="{{ $time }}" @if(old('consultation_time', $konseling->consultation_time) == $time) selected @endif>{{ sprintf('%02d', $i) }}:00</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                             <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="pending" @if(old('status', $konseling->status) == 'pending') selected @endif>Pending</option>
                                <option value="confirmed" @if(old('status', $konseling->status) == 'confirmed') selected @endif>Confirmed</option>
                                <option value="completed" @if(old('status', $konseling->status) == 'completed') selected @endif>Completed</option>
                                <option value="cancelled" @if(old('status', $konseling->status) == 'cancelled') selected @endif>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $konseling->description) }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.konseling.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Update Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

