<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Konseling') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Toolbar Modern: Judul - Search - Aksi -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">

                <!-- 1. Judul -->
                <h3 class="text-lg font-bold text-gray-800 flex items-center whitespace-nowrap">
                    <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </span>
                    Daftar Sesi
                </h3>

                <!-- 2. Form Pencarian (Searching) -->
                <form action="{{ route('user.konseling.index') }}" method="GET"
                    class="w-full lg:w-auto flex-grow mx-0 lg:mx-8">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out shadow-sm"
                            placeholder="Cari nama psikolog, layanan, atau status...">

                        <!-- Trik: Simpan status sorting agar tidak reset saat search -->
                        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                        <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                    </div>
                </form>

                <!-- 3. Grup Tombol (Export & Create) -->
                <div class="flex items-center gap-3 flex-shrink-0">
                    <!-- Tombol Export Soft UI -->
                    <div class="flex bg-white border border-gray-200 rounded-lg p-1 shadow-sm">
                        <a href="{{ route('user.export.pdf') }}" target="_blank"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-md transition-colors"
                            title="PDF">
                            <svg class="w-5 h-5 mr-1 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg> PDF
                        </a>
                        <div class="w-px bg-gray-200 my-1"></div>
                        <a href="{{ route('user.export.excel') }}" target="_blank"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-green-50 hover:text-green-600 rounded-md transition-colors"
                            title="Excel">
                            <svg class="w-5 h-5 mr-1 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg> Excel
                        </a>
                    </div>

                    <!-- Tombol Buat Jadwal -->
                    <a href="{{ route('user.konseling.create') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg shadow-md transition-all hover:shadow-lg transform hover:-translate-y-0.5">
                        + Buat Jadwal
                    </a>
                </div>
            </div>


            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Berhasil!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Content List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($konselings->isEmpty())
                        <div class="text-center py-10 text-gray-500">
                            <p class="mb-2">Belum ada riwayat konseling.</p>
                            <a href="{{ route('user.konseling.create') }}" class="text-indigo-600 hover:underline">Yuk,
                                buat jadwal pertamamu!</a>
                        </div>
                    @else
                        <!-- Responsive Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full leading-normal">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <!-- KOLOM 1: TANGGAL (Sortable) -->
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors group">
                                            <a href="{{ route('user.konseling.index', ['sort_by' => 'consultation_date', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                                class="flex items-center justify-between">
                                                <span>Waktu & Tanggal</span>
                                                <span
                                                    class="ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">
                                                    @if (request('sort_by') == 'consultation_date')
                                                        @if (request('sort_direction') == 'asc')
                                                            <svg class="h-4 w-4 text-indigo-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 15l7-7 7 7"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="h-4 w-4 text-indigo-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                            </svg>
                                                        @endif
                                                    @else
                                                        <svg class="h-4 w-4 opacity-0 group-hover:opacity-50"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4">
                                                            </path>
                                                        </svg>
                                                    @endif
                                                </span>
                                            </a>
                                        </th>

                                        <!-- KOLOM 2: PSIKOLOG (Sortable) -->
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors group">
                                            <a href="{{ route('user.konseling.index', ['sort_by' => 'service_type', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                                class="flex items-center justify-between">
                                                <span>Psikolog & Layanan</span>
                                                <span
                                                    class="ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">
                                                    @if (request('sort_by') == 'service_type')
                                                        @if (request('sort_direction') == 'asc')
                                                            <svg class="h-4 w-4 text-indigo-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 15l7-7 7 7"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="h-4 w-4 text-indigo-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                            </svg>
                                                        @endif
                                                    @else
                                                        <svg class="h-4 w-4 opacity-0 group-hover:opacity-50"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4">
                                                            </path>
                                                        </svg>
                                                    @endif
                                                </span>
                                            </a>
                                        </th>

                                        <!-- KOLOM 3: MEDIA (Static) -->
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Media
                                        </th>

                                        <!-- KOLOM 4: STATUS (Sortable) -->
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors group">
                                            <a href="{{ route('user.konseling.index', ['sort_by' => 'status', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}"
                                                class="flex items-center justify-between">
                                                <span>Status</span>
                                                <span
                                                    class="ml-2 flex-none rounded text-gray-400 group-hover:visible group-focus:visible">
                                                    @if (request('sort_by') == 'status')
                                                        @if (request('sort_direction') == 'asc')
                                                            <svg class="h-4 w-4 text-indigo-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 15l7-7 7 7"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="h-4 w-4 text-indigo-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                            </svg>
                                                        @endif
                                                    @else
                                                        <svg class="h-4 w-4 opacity-0 group-hover:opacity-50"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4">
                                                            </path>
                                                        </svg>
                                                    @endif
                                                </span>
                                            </a>
                                        </th>

                                        <!-- KOLOM 5: AKSI (Static) -->
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($konselings as $k)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 font-bold whitespace-no-wrap">
                                                    {{ \Carbon\Carbon::parse($k->consultation_date)->format('d M Y') }}
                                                </p>
                                                <p class="text-gray-600 whitespace-no-wrap">
                                                    {{ $k->consultation_time }} WIB
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap font-semibold">
                                                    {{ $k->psikolog->name ?? 'Psikolog tidak ditemukan' }}
                                                </p>
                                                <span
                                                    class="text-xs text-gray-500">{{ ucfirst($k->service_type) }}</span>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $k->session_preference }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                @if ($k->status == 'pending')
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Menunggu</span>
                                                    </span>
                                                @elseif($k->status == 'confirmed')
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Dijadwalkan</span>
                                                    </span>
                                                @elseif($k->status == 'completed')
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
                                                    </span>
                                                @else
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Batal</span>
                                                    </span>
                                                @endif
                                            </td>

                                            {{-- KOLOM AKSI YANG SUDAH DIPERBAIKI --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                {{-- 1. JIKA STATUS CONFIRMED (Jadwal Disetujui) --}}
                                                @if ($k->status == 'confirmed')
                                                    @if ($k->meeting_link)
                                                        <a href="{{ $k->meeting_link }}" target="_blank"
                                                            class="inline-flex items-center px-3 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-green-700 transition">
                                                            🎥 Gabung Meet
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400 italic">Link belum ada</span>
                                                    @endif

                                                    {{-- 2. JIKA STATUS COMPLETED (Sesi Selesai) --}}
                                                @elseif($k->status == 'completed')
                                                    {{-- CEK: Apakah sudah ada rating di database? --}}
                                                    @if (!$k->rating)
                                                        {{-- KALO BELUM ADA RATING: TAMPILKAN TOMBOL --}}
                                                        <a href="{{ route('user.konseling.review', $k->id) }}"
                                                            class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-yellow-600 transition shadow-sm">
                                                            ⭐ Beri Ulasan
                                                        </a>
                                                    @else
                                                        {{-- KALO SUDAH ADA RATING: TAMPILKAN BINTANG --}}
                                                        <div class="flex flex-col items-start">
                                                            <div class="text-yellow-400 text-sm tracking-wide">
                                                                @for ($i = 0; $i < $k->rating; $i++)
                                                                    ★
                                                                @endfor
                                                                @for ($i = $k->rating; $i < 5; $i++)
                                                                    <span class="text-gray-300">★</span>
                                                                @endfor
                                                            </div>
                                                            <span class="text-[10px] text-gray-400">Terkirim</span>
                                                        </div>
                                                    @endif

                                                    {{-- 3. STATUS LAINNYA (Pending/Cancelled) --}}
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $konselings->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
