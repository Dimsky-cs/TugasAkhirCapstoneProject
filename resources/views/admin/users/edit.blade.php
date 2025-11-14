<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Edit User: {{ $user->name }}</h2>
                <p class="text-gray-500 mb-8">Perbarui detail untuk akun ini.</p>

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

                <!-- Form -->
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="md:col-span-2 border-t pt-6">
                            <p class="text-sm text-gray-500">Isi password hanya jika Kamu ingin menggantinya.</p>
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru
                                (Opsional)</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Role -->
                        <div class="md:col-span-2 border-t pt-6">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="user" @if (old('role', $user->role) == 'user') selected @endif>User (Klien)
                                </option>
                                <option value="psikolog" @if (old('role', $user->role) == 'psikolog') selected @endif>Psikolog
                                </option>
                                <option value="admin" @if (old('role', $user->role) == 'admin') selected @endif>Admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- [BARU] Spesialisasi Psikolog (Hanya muncul jika 'psikolog' dipilih) -->
                    @php
                        // Cek old input, ATAU data asli dari database
                        $currentSpecialties = old('specialties', $user->specialties ?? []);
                        $isPsikolog = old('role', $user->role) == 'psikolog';
                    @endphp
                    <div id="specialties-container" class="mt-6 {{ $isPsikolog ? '' : 'hidden' }}">
                        <label class="block text-sm font-medium text-gray-700">Spesialisasi (Jika Psikolog)</label>
                        <div class="mt-2 grid grid-cols-2 gap-4">
                            @foreach ($specialtiesList as $specialty)
                                <label class="flex items-center">
                                    <input type="checkbox" name="specialties[]" value="{{ $specialty }}"
                                        @if (is_array($currentSpecialties) && in_array($specialty, $currentSpecialties)) checked @endif
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">{{ ucfirst($specialty) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Batal</a>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">Update
                            User</button>
                    </div>
                </form>

                <script>
                    // JavaScript untuk menampilkan/menyembunyikan checkbox spesialisasi
                    document.getElementById('role').addEventListener('change', function() {
                        var container = document.getElementById('specialties-container');
                        if (this.value === 'psikolog') {
                            container.classList.remove('hidden');
                        } else {
                            container.classList.add('hidden');
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
