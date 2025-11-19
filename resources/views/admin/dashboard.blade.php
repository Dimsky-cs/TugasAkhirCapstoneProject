<x-app-layout>
    <div class="bg-gray-100 min-h-screen pb-12">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Header -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="text-gray-500">Ringkasan aktivitas platform hari ini.</p>
                </div>

                <!-- 1. STAT CARDS (Grid 5 Kolom) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                    <!-- User -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Klien</p>
                                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['totalPengguna'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Psikolog -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Psikolog</p>
                                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['totalPsikolog'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Total -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-green-100 text-green-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Total Sesi</p>
                                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['totalBooking'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Pending</p>
                                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['bookingPending'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Selesai -->
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-pink-100 text-pink-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Selesai</p>
                                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['sesiSelesai'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. SECTION CHARTS (GRID LAYOUT) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                    <!-- Chart 1: Tren Booking (Line) -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-indigo-500 rounded-full mr-2"></span>
                            Tren Booking (7 Hari)
                        </h3>
                        <div class="relative h-64">
                            <canvas id="bookingTrendChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 2: Layanan Populer (Doughnut - Lebih Modern dari Pie) -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-pink-500 rounded-full mr-2"></span>
                            Kategori Masalah Terpopuler
                        </h3>
                        <div class="relative h-64 flex justify-center">
                            <canvas id="layananChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 3: Metode Sesi (Bar Horizontal) -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-green-500 rounded-full mr-2"></span>
                            Metode Konseling Favorit
                        </h3>
                        <div class="relative h-64">
                            <canvas id="methodChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 4: Hari Tersibuk (Bar Vertical) -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-2 h-6 bg-orange-500 rounded-full mr-2"></span>
                            Hari Paling Sibuk
                        </h3>
                        <div class="relative h-64">
                            <canvas id="dayChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- 3. TABEL DATA TERBARU -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="p-6 flex justify-between items-center border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800">Menunggu Konfirmasi Terbaru</h3>
                        <a href="{{ route('admin.konseling.index') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-white">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Klien</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Psikolog</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jadwal</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($konselingsPending as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $booking->client_name }}
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $booking->service_type }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $booking->psikolog->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($booking->consultation_date)->isoFormat('D MMM') }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($booking->consultation_time)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.konseling.edit', $booking->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">Tidak
                                            ada jadwal pending saat ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SCRIPT CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // --- CONFIG UMUM (Agar Chart Rapi) ---
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b';

            // --- CHART 1: TREN BOOKING (Area Chart) ---
            new Chart(document.getElementById('bookingTrendChart'), {
                type: 'line',
                data: {
                    labels: @json($chartBookingLabels),
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: @json($chartBookingData),
                        borderColor: '#6366f1', // Indigo
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4 // Membuat garis melengkung halus
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 4]
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // --- CHART 2: LAYANAN (Doughnut Chart) ---
            new Chart(document.getElementById('layananChart'), {
                type: 'doughnut',
                data: {
                    labels: @json($chartLayananLabels),
                    datasets: [{
                        data: @json($chartLayananData),
                        backgroundColor: ['#ec4899', '#8b5cf6', '#3b82f6', '#10b981', '#f59e0b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%', // Membuat lubang tengah lebih besar
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                }
            });

            // --- CHART 3: METODE FAVORIT (Horizontal Bar) ---
            new Chart(document.getElementById('methodChart'), {
                type: 'bar',
                data: {
                    labels: @json($chartMethodLabels),
                    datasets: [{
                        label: 'Peminat',
                        data: @json($chartMethodData),
                        backgroundColor: '#10b981', // Emerald Green
                        borderRadius: 5
                    }]
                },
                options: {
                    indexAxis: 'y', // Membuat Bar jadi Horizontal
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // --- CHART 4: HARI TERSIBUK (Vertical Bar) ---
            new Chart(document.getElementById('dayChart'), {
                type: 'bar',
                data: {
                    labels: @json($chartDayLabels),
                    datasets: [{
                        label: 'Total Sesi',
                        data: @json($chartDayData),
                        backgroundColor: '#f97316', // Orange
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });
    </script>
</x-app-layout>
