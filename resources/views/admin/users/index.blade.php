<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Manajemen User (Administrator)</h2>
                        <p class="text-gray-500">Kelola semua akun di platform.</p>
                    </div>
                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none transition ease-in-out duration-150 shadow-md">
                        Tambah User Baru
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Card Filter & Table -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-6">

                    <!-- Form Pencarian & Filter -->
                    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                            <!-- Search -->
                            <div class="md:col-span-6">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari (Nama
                                    atau Email)</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                    placeholder="Ketik nama atau email...">
                            </div>

                            <!-- Filter Role -->
                            <div class="md:col-span-4">
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Filter
                                    Role</label>
                                <select name="role" id="role"
                                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="">Semua Role</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                        (Klien)</option>
                                    <option value="psikolog" {{ request('role') == 'psikolog' ? 'selected' : '' }}>
                                        Psikolog</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                </select>
                            </div>

                            <!-- Tombol Filter -->
                            <div class="md:col-span-2">
                                <button type="submit"
                                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition font-semibold shadow-sm">
                                    Filter
                                </button>
                            </div>

                            <!-- Jaga State Sorting saat Filter -->
                            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                            <input type="hidden" name="sort_direction" value="{{ request('sort_direction') }}">
                        </div>
                    </form>

                    <!-- Tabel User -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border border-gray-100 rounded-lg">
                            <thead class="bg-gray-50">
                                <tr>
                                    <!-- Kolom NAMA (Sortable) -->
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group hover:bg-gray-100 transition">
                                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'name', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="flex items-center">
                                            Nama / Email
                                            <span class="ml-1 text-gray-400 group-hover:text-indigo-600">
                                                @if (request('sort_by') == 'name')
                                                    {{ request('sort_direction') == 'asc' ? '▲' : '▼' }}
                                                @else
                                                    ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>

                                    <!-- Kolom ROLE (Sortable) -->
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group hover:bg-gray-100 transition">
                                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'role', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="flex items-center">
                                            Role
                                            <span class="ml-1 text-gray-400 group-hover:text-indigo-600">
                                                @if (request('sort_by') == 'role')
                                                    {{ request('sort_direction') == 'asc' ? '▲' : '▼' }}
                                                @else
                                                    ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Provider
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Spesialisasi
                                    </th>

                                    <!-- Kolom TANGGAL GABUNG (Sortable) -->
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group hover:bg-gray-100 transition">
                                        <a href="{{ route('admin.users.index', array_merge(request()->all(), ['sort_by' => 'created_at', 'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="flex items-center">
                                            Tgl. Gabung
                                            <span class="ml-1 text-gray-400 group-hover:text-indigo-600">
                                                @if (request('sort_by') == 'created_at')
                                                    {{ request('sort_direction') == 'asc' ? '▲' : '▼' }}
                                                @else
                                                    ⇅
                                                @endif
                                            </span>
                                        </a>
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($user->role == 'admin')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Admin</span>
                                            @elseif($user->role == 'psikolog')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Psikolog</span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">User</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->provider_name ? ucfirst($user->provider_name) : 'Email/Pass' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if ($user->role == 'psikolog' && !empty($user->specialties))
                                                {{ implode(', ', $user->specialties) }}
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center space-x-3">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>

                                                @if (Auth::id() !== $user->id)
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus user ini? Data tidak bisa dikembalikan.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">Tidak ada
                                            user yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
