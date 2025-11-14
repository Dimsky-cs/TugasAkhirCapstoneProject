<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Psikolog</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-yellow-100 p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold text-yellow-800">Menunggu Konfirmasi</h3>
                        <p class="text-4xl font-extrabold text-yellow-900 mt-2">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="bg-green-100 p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold text-green-800">Terkonfirmasi (Akan Datang)</h3>
                        <p class="text-4xl font-extrabold text-green-900 mt-2">{{ $stats['confirmed'] }}</p>
                    </div>
                    <div class="bg-blue-100 p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold text-blue-800">Sesi Selesai</h3>
                        <p class="text-4xl font-extrabold text-blue-900 mt-2">{{ $stats['completed'] }}</p>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md"
                        role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <h3 class="text-xl font-bold text-gray-800 p-6 border-b">Semua Sesi Anda</h3>
                    <div class="overflow-x-auto">
                        @if ($konselings->isEmpty())
                            <p class="p-6 text-gray-500 text-center">Anda belum memiliki jadwal konseling.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Klien</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Layanan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jadwal</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Preferensi</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($konselings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->client_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->user->email ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-700">{{ ucfirst($booking->service_type) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($booking->consultation_date)->isoFormat('dddd, D MMM Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($booking->consultation_time)->format('H:i') }}
                                                    WIB</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-700">
                                                    {{ $booking->session_preference ?? 'N/A' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($booking->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                @if ($booking->status == 'confirmed') bg-green-100 text-green-800 @endif
                                                @if ($booking->status == 'completed') bg-blue-100 text-blue-800 @endif
                                                @if ($booking->status == 'cancelled') bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('psikolog.sesi.edit', $booking->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Ubah Status</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="p-4 bg-gray-50 border-t">
                        {{ $konselings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
