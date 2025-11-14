<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Salam Pembuka -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="text-gray-500">Berikut adalah ringkasan aktivitas di Gen-z Psychology.</p>
                </div>

                <!-- [UPDATE] 5 KARTU STATS -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
                    <!-- Total Pengguna (User) -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.003c0 1.113.285 2.16.786 3.07M15 19.128H6.84a4.125 4.125 0 01-7.533-2.493 4.125 4.125 0 017.533 2.493H3.356c1.113 0 2.16.285 3.07.786v.003z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Klien (User)</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['totalPengguna'] }}</p>
                        </div>
                    </div>
                    <!-- Total Psikolog -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Psikolog</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['totalPsikolog'] }}</p>
                        </div>
                    </div>
                    <!-- Total Booking -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Booking</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['totalBooking'] }}</p>
                        </div>
                    </div>
                    <!-- Booking Pending -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Booking Pending</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['bookingPending'] }}</p>
                        </div>
                    </div>
                    <!-- Sesi Selesai -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-pink-100 text-pink-600">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Sesi Selesai</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['sesiSelesai'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- [BARU] VISUALISASI DATA (CHARTS) -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 mb-8">
                    <!-- Line Chart (Tren Booking) -->
                    <div class="lg:col-span-3 bg-white p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Tren Booking (7 Hari Terakhir)</h3>
                        <canvas id="bookingTrendChart"></canvas>
                    </div>
                    <!-- Pie Chart (Layanan Populer) -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Layanan Terpopuler</h3>
                        <canvas id="layananChart"></canvas>
                    </div>
                </div>


                <!-- Tabel "Jadwal Perlu Konfirmasi" (Sama seperti sebelumnya) -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 flex justify-between items-center border-b">
                        <h3 class="text-xl font-bold text-gray-800">Jadwal Konseling Perlu Konfirmasi</h3>
                        <a href="{{ route('admin.konseling.index') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Lihat Semua Jadwal
                            &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        @if ($konselingsPending->isEmpty())
                            <p class="p-6 text-gray-500 text-center">Tidak ada jadwal yang perlu dikonfirmasi saat ini.
                            </p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Klien</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Psikolog</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jadwal Diajukan</th>
                                        <th
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($konselingsPending as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->client_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $booking->service_type }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $booking->psikolog->name ?? 'N/A' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($booking->consultation_date)->isoFormat('D MMM Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($booking->consultation_time)->format('H:i') }}
                                                    WIB</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.konseling.edit', $booking->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- [BARU] SCRIPT UNTUK MENJALANKAN CHARTS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- Chart 1: Tren Booking (Line Chart) ---
            const bookingCtx = document.getElementById('bookingTrendChart');
            if (bookingCtx) {
                new Chart(bookingCtx, {
                    type: 'line',
                    data: {
                        labels: @json($chartBookingLabels),
                        datasets: [{
                            label: 'Jumlah Booking',
                            data: @json($chartBookingData),
                            borderColor: 'rgb(79, 70, 229)', // Indigo-600
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // Hanya tampilkan angka bulat (1, 2, 3... bukan 1.5)
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            }

            // --- Chart 2: Layanan Populer (Pie Chart) ---
            const layananCtx = document.getElementById('layananChart');
            if (layananCtx) {
                new Chart(layananCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($chartLayananLabels),
                        datasets: [{
                            label: 'Jumlah Sesi',
                            data: @json($chartLayananData),
                            backgroundColor: [
                                'rgb(236, 72, 153)', // Pink-500
                                'rgb(34, 197, 94)', // Green-500
                                'rgb(168, 85, 247)', // Purple-500
                                'rgb(234, 179, 8)', // Yellow-500
                            ],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                    }
                });
            }
        });
    </script>
</x-app-layout>
