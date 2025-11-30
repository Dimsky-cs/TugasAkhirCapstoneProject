<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Header Utama & Tombol Tambah -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Manajemen Jadwal</h2>
                        <p class="text-gray-500">Pantau seluruh sesi konseling di platform.</p>
                    </div>
                    <a href="{{ route('admin.konseling.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 shadow-md transition ease-in-out duration-150">
                        + Tambah Jadwal
                    </a>
                </div>

                <!-- Alert Sukses -->
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md"
                        role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Card Tabel -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <!-- Toolbar Admin: Judul, Filter, Search, Export -->
                        <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-4">

                            <!-- Judul Kecil -->
                            <div>
                                <h1 class="text-xl font-bold text-gray-800">Semua Data</h1>
                            </div>

                            <!-- Grup Kanan: Filter, Search & Export -->
                            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto items-center">

                                <!-- Form Gabungan (Filter & Search) -->
                                <form action="{{ route('admin.konseling.index') }}" method="GET"
                                    class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">

                                    <!-- [BARU] Filter Status -->
                                    <select name="status" onchange="this.form.submit()"
                                        class="pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:ring-gray-800 focus:border-gray-800 text-sm">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="confirmed"
                                            {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="completed"
                                            {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled"
                                            {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>

                                    <!-- Search Input -->
                                    <div class="relative w-full sm:w-64">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            placeholder="Cari Klien / Psikolog..."
                                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-gray-800 focus:border-gray-800 text-sm w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Hidden Sorting (Agar tidak reset saat filter) -->
                                    <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                                    <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                                </form>

                                <!-- Tombol Export -->
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.export.pdf') }}" target="_blank"
                                        class="px-4 py-2 bg-gray-800 text-white rounded text-xs font-bold uppercase hover:bg-gray-700 flex items-center transition">
                                        PDF
                                    </a>
                                    <a href="{{ route('admin.export.excel') }}" target="_blank"
                                        class="px-4 py-2 bg-green-600 text-white rounded text-xs font-bold uppercase hover:bg-green-700 flex items-center transition">
                                        Excel
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL ADMIN -->
                        <div class="overflow-x-auto mt-4">
                            @if ($konselings->isEmpty())
                                <p class="p-6 text-gray-500 text-center bg-gray-50 rounded-lg">Belum ada data booking
                                    konseling yang sesuai.</p>
                            @else
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <!-- Klien (Sortable) -->
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                                <a href="{{ route('admin.konseling.index', array_merge(request()->all(), ['sort_by' => 'user_id', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                                    class="flex items-center">
                                                    Klien
                                                    <span class="ml-1 text-gray-400 group-hover:text-gray-800">⇅</span>
                                                </a>
                                            </th>

                                            <!-- Jadwal (Sortable) -->
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                                <a href="{{ route('admin.konseling.index', array_merge(request()->all(), ['sort_by' => 'consultation_date', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                                    class="flex items-center">
                                                    Jadwal
                                                    <span class="ml-1 text-gray-400 group-hover:text-gray-800">
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
                                                Psikolog</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Preferensi</th>

                                            <!-- Status (Sortable) -->
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group">
                                                <a href="{{ route('admin.konseling.index', array_merge(request()->all(), ['sort_by' => 'status', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                                    class="flex items-center">
                                                    Status
                                                    <span class="ml-1 text-gray-400 group-hover:text-gray-800">⇅</span>
                                                </a>
                                            </th>

                                            <!-- Rating & Ulasan -->
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rating & Ulasan
                                            </th>

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
                                                    <div class="text-sm text-gray-500">
                                                        {{ $booking->user->email ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ \Carbon\Carbon::parse($booking->consultation_date)->format('d M Y') }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $booking->consultation_time }} WIB</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $booking->psikolog->name ?? 'Belum Ditugaskan' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-700">
                                                        {{ $booking->session_preference }}</div>
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

                                                <!-- Isi Kolom Rating -->
                                                <td class="px-6 py-4">
                                                    @if ($booking->status == 'completed')
                                                        @if ($booking->rating)
                                                            <div class="flex flex-col">
                                                                <div class="text-yellow-400 text-xs tracking-wide mb-1">
                                                                    @for ($i = 0; $i < $booking->rating; $i++)
                                                                        ★
                                                                    @endfor
                                                                    <span
                                                                        class="text-gray-400 ml-1">({{ $booking->rating }}/5)</span>
                                                                </div>
                                                                @if ($booking->review)
                                                                    <p class="text-xs text-gray-600 italic line-clamp-2"
                                                                        title="{{ $booking->review }}">
                                                                        "{{ Str::limit($booking->review, 30) }}"
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <span class="text-xs text-gray-400 italic">Belum ada
                                                                ulasan</span>
                                                        @endif
                                                    @else
                                                        <span class="text-gray-300">-</span>
                                                    @endif
                                                </td>

                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div class="flex justify-end items-center space-x-2">
                                                        <a href="{{ route('admin.konseling.edit', $booking->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                        <form
                                                            action="{{ route('admin.konseling.destroy', $booking->id) }}"
                                                            method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-600 hover:text-red-900">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                        <!-- Pagination -->
                        <div class="p-4 bg-gray-50 border-t">
                            {{ $konselings->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
