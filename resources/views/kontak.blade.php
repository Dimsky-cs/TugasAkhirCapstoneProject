<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kontak
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <p>Hubungi kami untuk informasi lebih lanjut:</p>
            <p>Email: info@psikologionline.com</p>
            <p>Whatsapp: <a href="https://wa.me/6281234567890" class="text-blue-600">+62 812-3456-7890</a></p>

            <form action="#" method="POST" class="mt-4">
                @csrf
                <label class="block mb-2">Nama</label>
                <input type="text" name="nama" class="border p-2 w-full">

                <label class="block mt-4 mb-2">Pesan</label>
                <textarea name="pesan" rows="4" class="border p-2 w-full"></textarea>

                <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
            </form>
        </div>
    </div>
</x-app-layout>
