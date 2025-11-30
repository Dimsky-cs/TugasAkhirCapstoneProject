<x-app-layout>
    <div class="bg-gray-100 min-h-screen pb-10">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- HEADER: Salam & Tombol Aksi Cepat -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="text-gray-500">Ringkasan aktivitas platform bulan {{ $currentMonth }}.</p>
                    </div>

                    <!-- [BARU] Tombol Akses Cepat -->
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-md transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            Manajemen User
                        </a>
                        <a href="{{ route('admin.konseling.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 shadow-md transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Manajemen Jadwal
                        </a>
                    </div>
                </div>

                <!-- STAT CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
                    <!-- User -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Klien</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['totalPengguna'] }}</p>
                    </div>
                    <!-- Psikolog -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Psikolog</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['totalPsikolog'] }}</p>
                    </div>
                    <!-- Total Sesi -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="p-2 bg-green-100 text-green-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Total Sesi</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['totalBooking'] }}</p>
                    </div>
                    <!-- Pending -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="p-2 bg-yellow-100 text-yellow-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Pending</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['bookingPending'] }}</p>
                    </div>
                    <!-- Selesai -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition flex flex-col justify-between">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="p-2 bg-pink-100 text-pink-600 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Selesai</p>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ $stats['sesiSelesai'] }}</p>
                    </div>
                </div>

                <!-- CHARTS SECTION -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                    <!-- Chart 1: Tren Booking (Update: BULANAN) -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3
                            class="text-lg font-bold text-gray-800 mb-4 flex items-center border-l-4 border-indigo-500 pl-3">
                            Tren Booking ({{ $currentMonth }})
                        </h3>
                        <div class="relative h-64">
                            <canvas id="bookingTrendChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 2: Layanan Populer -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3
                            class="text-lg font-bold text-gray-800 mb-4 flex items-center border-l-4 border-pink-500 pl-3">
                            Kategori Masalah Terpopuler
                        </h3>
                        <div class="relative h-64 flex justify-center">
                            <canvas id="layananChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 3: Metode Konseling -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3
                            class="text-lg font-bold text-gray-800 mb-4 flex items-center border-l-4 border-green-500 pl-3">
                            Metode Konseling Favorit
                        </h3>
                        <div class="relative h-64">
                            <canvas id="methodChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 4: Hari Tersibuk -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <h3
                            class="text-lg font-bold text-gray-800 mb-4 flex items-center border-l-4 border-orange-500 pl-3">
                            Hari Paling Sibuk
                        </h3>
                        <div class="relative h-64">
                            <canvas id="dayChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- TABEL MENUNGGU KONFIRMASI -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="p-6 flex justify-between items-center border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800">Menunggu Konfirmasi Terbaru</h3>
                        <a href="{{ route('admin.konseling.index') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Semua &rarr;</a>
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

            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b';

            new Chart(document.getElementById('bookingTrendChart'), {
                type: 'line',
                data: {
                    labels: @json($chartBookingLabels),
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: @json($chartBookingData),
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
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
                            },
                            ticks: {
                                precision: 0
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
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                }
            });

            new Chart(document.getElementById('methodChart'), {
                type: 'bar',
                data: {
                    labels: @json($chartMetodeLabels),
                    datasets: [{
                        label: 'Peminat',
                        data: @json($chartMetodeData),
                        backgroundColor: '#10b981',
                        borderRadius: 5
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById('dayChart'), {
                type: 'bar',
                data: {
                    labels: @json($chartHariLabels),
                    datasets: [{
                        label: 'Total Sesi',
                        data: @json($chartHariData),
                        backgroundColor: '#f97316',
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
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
