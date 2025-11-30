<x-app-layout>
    <div class="bg-gray-100 min-h-screen pb-10">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- HEADER -->
                <div class="mb-8 flex flex-col md:flex-row justify-between items-end gap-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Dashboard Psikolog</h2>
                        <p class="text-gray-500">Selamat datang, {{ Auth::user()->name }}. Pantau jadwal dan performa
                            Anda.</p>
                    </div>
                </div>

                <!-- STATISTIK RINGKAS -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-yellow-100 p-6 rounded-2xl shadow-sm border border-yellow-200">
                        <h3 class="text-lg font-bold text-yellow-800">Menunggu Konfirmasi</h3>
                        <p class="text-4xl font-extrabold text-yellow-900 mt-2">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="bg-green-100 p-6 rounded-2xl shadow-sm border border-green-200">
                        <h3 class="text-lg font-bold text-green-800">Terkonfirmasi (Akan Datang)</h3>
                        <p class="text-4xl font-extrabold text-green-900 mt-2">{{ $stats['confirmed'] }}</p>
                    </div>
                    <div class="bg-blue-100 p-6 rounded-2xl shadow-sm border border-blue-200">
                        <h3 class="text-lg font-bold text-blue-800">Sesi Selesai</h3>
                        <p class="text-4xl font-extrabold text-blue-900 mt-2">{{ $stats['completed'] }}</p>
                    </div>
                </div>

                <!-- CARD UTAMA: JADWAL KONSULTASI -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">

                    <!-- Toolbar Table -->
                    <div
                        class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Jadwal Konsultasi</h3>
                            <p class="text-sm text-gray-500">Kelola sesi yang ditugaskan kepada Anda.</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                            <!-- Search -->
                            <form action="{{ route('psikolog.dashboard') }}" method="GET" class="relative">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari nama klien..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm w-full sm:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <!-- Keep sort state -->
                                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                                <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                            </form>

                            <!-- Export Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('psikolog.export.pdf') }}" target="_blank"
                                    class="flex items-center px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm font-semibold shadow-sm transition">
                                    <span class="mr-1">📄</span> PDF
                                </a>
                                <a href="{{ route('psikolog.export.excel') }}" target="_blank"
                                    class="flex items-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-semibold shadow-sm transition">
                                    <span class="mr-1">📊</span> XLS
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        @if ($konselings->isEmpty())
                            <p class="p-8 text-center text-gray-500 bg-gray-50">Belum ada jadwal konseling yang
                                ditemukan.</p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <!-- Kolom Klien -->
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Klien</th>

                                        <!-- Kolom Waktu (Sortable) -->
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition group">
                                            <a href="{{ route('psikolog.dashboard', ['sort_by' => 'consultation_date', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                                class="flex items-center">
                                                Waktu
                                                <span class="ml-1 text-gray-400 group-hover:text-indigo-600">
                                                    @if (request('sort_by') == 'consultation_date')
                                                        {{ request('sort_direction') == 'asc' ? '▲' : '▼' }}
                                                    @else
                                                        ⇅
                                                    @endif
                                                </span>
                                            </a>
                                        </th>

                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Layanan</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Media</th>

                                        <!-- Kolom Status (Sortable) -->
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition group">
                                            <a href="{{ route('psikolog.dashboard', ['sort_by' => 'status', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                                class="flex items-center">
                                                Status
                                                <span class="ml-1 text-gray-400 group-hover:text-indigo-600">
                                                    @if (request('sort_by') == 'status')
                                                        {{ request('sort_direction') == 'asc' ? '▲' : '▼' }}
                                                    @else
                                                        ⇅
                                                    @endif
                                                </span>
                                            </a>
                                        </th>

                                        <!-- Kolom Rating & Ulasan -->
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">
                                            Rating & Ulasan
                                        </th>

                                        <th
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($konselings as $booking)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <!-- Klien -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">
                                                    {{ $booking->client_name }}</div>
                                                <div class="text-xs text-gray-500">{{ $booking->client_email ?? '-' }}
                                                </div>
                                            </td>

                                            <!-- Waktu -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 font-medium">
                                                    {{ \Carbon\Carbon::parse($booking->consultation_date)->format('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">{{ $booking->consultation_time }}
                                                    WIB</div>
                                            </td>

                                            <!-- Layanan -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-700">
                                                    {{ ucfirst($booking->service_type) }}</div>
                                            </td>

                                            <!-- Media -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                                    {{ $booking->session_preference }}
                                                </span>
                                            </td>

                                            <!-- Status -->
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if ($booking->status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200 @endif
                                                    @if ($booking->status == 'confirmed') bg-green-100 text-green-800 border border-green-200 @endif
                                                    @if ($booking->status == 'completed') bg-blue-100 text-blue-800 border border-blue-200 @endif
                                                    @if ($booking->status == 'cancelled') bg-red-100 text-red-800 border border-red-200 @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>

                                            <!-- Rating & Ulasan -->
                                            <td class="px-6 py-4">
                                                @if ($booking->status == 'completed')
                                                    @if ($booking->rating)
                                                        <div class="flex flex-col">
                                                            <div class="text-yellow-400 text-xs tracking-wide mb-1">
                                                                @for ($i = 0; $i < $booking->rating; $i++)
                                                                    ★
                                                                @endfor
                                                                <span
                                                                    class="text-gray-400 ml-1 text-[10px]">({{ $booking->rating }}/5)</span>
                                                            </div>
                                                            @if ($booking->review)
                                                                <p class="text-xs text-gray-600 italic line-clamp-2"
                                                                    title="{{ $booking->review }}">
                                                                    "{{ Str::limit($booking->review, 40) }}"
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <span class="text-xs text-gray-400 italic">- Belum diulas
                                                            -</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-300 text-xs">-</span>
                                                @endif
                                            </td>

                                            <!-- Aksi -->
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('psikolog.sesi.edit', $booking->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-bold transition">
                                                    Update
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <!-- Pagination -->
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        {{ $konselings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
