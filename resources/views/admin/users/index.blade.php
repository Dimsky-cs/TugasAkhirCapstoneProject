<x-app-layout>
    <div class="bg-gray-100 min-h-screen">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Manajemen User (Administrator)</h2>
                        <p class="text-gray-500">Kelola semua akun di platform.</p>
                    </div>
                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Tambah User Baru
                    </a>
                </div>

                <!-- [FORM FILTER SUDAH BENAR] -->
                <div class="mb-6 bg-white rounded-2xl shadow-lg p-6">
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Input Pencarian -->
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700">Cari (Nama atau
                                    Email)</label>
                                <input type="text" name="search" id="search"
                                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    value="{{ $search ?? '' }}" placeholder="Ketik nama atau email...">
                            </div>
                            <!-- Filter Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Filter
                                    Role</label>
                                <select id="role" name="role"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Semua Role</option>
                                    <option value="admin" @if ($role == 'admin') selected @endif>Admin
                                    </option>
                                    <option value="psikolog" @if ($role == 'psikolog') selected @endif>Psikolog
                                    </option>
                                    <option value="user" @if ($role == 'user') selected @endif>User
                                        (Klien)</option>
                                </select>
                            </div>
                            <!-- Tombol -->
                            <div class="self-end">
                                <button type="submit"
                                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md"
                        role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md"
                        role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <!-- [PERBAIKAN] Kolom ID dihapus -->
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama / Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Provider</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Spesialisasi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tgl. Gabung</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr>
                                        <!-- [PERBAIKAN] Kolom ID dihapus -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 flex items-center">
                                                {{ $user->name }}
                                                <!-- Ikon verifikasi email -->
                                                @if ($user->email_verified_at)
                                                    <svg class="w-4 h-4 ml-1 text-green-500"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($user->role == 'admin') bg-red-100 text-red-800 @endif
                                            @if ($user->role == 'psikolog') bg-purple-100 text-purple-800 @endif
                                            @if ($user->role == 'user') bg-blue-100 text-blue-800 @endif">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->provider_name ?? 'Email/Pass' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"
                                            style="max-width: 200px; white-space: normal;">
                                            @if ($user->role == 'psikolog' && $user->specialties)
                                                {{ implode(', ', $user->specialties) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center space-x-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                @if (Auth::id() !== $user->id)
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Kamu yakin ingin menghapus user ini? Ini tidak bisa dibatalkan.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900">Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <!-- [PERBAIKAN] Colspan diubah jadi 6 -->
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            Tidak ada user yang cocok dengan filter pencarian.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 bg-gray-50 border-t">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
