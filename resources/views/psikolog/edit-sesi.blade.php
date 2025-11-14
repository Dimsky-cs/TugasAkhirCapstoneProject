<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Ubah Status Sesi</h2>
                <p class="text-gray-500 mb-8">Konfirmasi atau selesaikan sesi dengan klien.</p>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Oops! Terjadi kesalahan.</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('psikolog.sesi.update', $konseling->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 p-6 bg-gray-50 rounded-lg border">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Klien</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $konseling->client_name }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Layanan</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ ucfirst($konseling->service_type) }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Jadwal</h4>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($konseling->consultation_date)->isoFormat('D MMM Y') }},
                                {{ \Carbon\Carbon::parse($konseling->consultation_time)->format('H:i') }} WIB</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Preferensi Sesi</h4>
                            <p class="text-lg font-semibold text-gray-900">{{ $konseling->session_preference }}</p>
                        </div>
                    </div>


                    <div class="mt-6">
                        <label for="status" class="block text-lg font-medium text-gray-700">Ubah Status
                            Menjadi:</label>
                        <select name="status"
                            class="mt-1 block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-lg rounded-md">
                            <option value="pending" @if (old('status', $konseling->status) == 'pending') selected @endif disabled>Pending
                            </option>
                            <option value="confirmed" @if (old('status', $konseling->status) == 'confirmed') selected @endif>Confirmed
                                (Konfirmasi Jadwal)</option>
                            <option value="completed" @if (old('status', $konseling->status) == 'completed') selected @endif>Completed (Sesi
                                Selesai)</option>
                            <option value="cancelled" @if (old('status', $konseling->status) == 'cancelled') selected @endif>Cancelled
                                (Batalkan Sesi)</option>
                        </select>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('psikolog.dashboard') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Batal</a>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Update
                            Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
