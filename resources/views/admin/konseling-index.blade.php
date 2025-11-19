<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Semua Konseling
        </h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            @if ($konselings->isEmpty())
                <p>Belum ada pengajuan konseling dari user.</p>
            @else
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Nama User</th>
                            <th class="border px-4 py-2">Layanan</th>
                            <th class="border px-4 py-2">Deskripsi</th>
                            <th class="border px-4 py-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konselings as $k)
                            <tr>
                                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border px-4 py-2">{{ $k->user->name }}</td>
                                <td class="border px-4 py-2">{{ $k->layanan }}</td>
                                <td class="border px-4 py-2">{{ $k->deskripsi }}</td>
                                <td class="border px-4 py-2">{{ $k->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
