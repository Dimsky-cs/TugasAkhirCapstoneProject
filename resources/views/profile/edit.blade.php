<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Pengaturan Akun') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- KOLOM KIRI -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Card 1: Profil -->
                    <div class="p-8 bg-white shadow-lg rounded-2xl border-t-4 border-pink-500">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Informasi Profil</h3>
                            <p class="text-sm text-gray-500">Perbarui nama akun dan alamat email Kamu.</p>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Card 2: Password -->
                    <div class="p-8 bg-white shadow-lg rounded-2xl border-t-4 border-indigo-500">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Ganti Password</h3>
                            <p class="text-sm text-gray-500">Pastikan akun Kamu aman dengan password yang kuat.</p>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="lg:col-span-1">
                    <div class="p-8 bg-white shadow-lg rounded-2xl border-t-4 border-red-500 h-full">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-red-600 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                Hapus Akun
                            </h3>
                            <p class="text-sm text-gray-500">
                                Tindakan ini bersifat permanen. Setelah akun dihapus, semua data dan riwayat Kamu akan
                                hilang selamanya.
                            </p>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
