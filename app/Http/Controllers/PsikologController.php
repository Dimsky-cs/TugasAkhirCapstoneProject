<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Kita butuh ini untuk validasi

class PsikologController extends Controller
{
    /**
     * Menampilkan dashboard untuk Psikolog.
     * Hanya menampilkan jadwal yang di-assign ke dia.
     */
    public function index()
    {
        $psikologId = Auth::id();

        // Ambil data konseling HANYA untuk psikolog ini
        $konselings = Konseling::with('user') // Ambil data klien (user)
            ->where('psikolog_id', $psikologId)
            ->orderBy('consultation_date', 'desc')
            ->paginate(10);

        // Ambil statistik simpel untuk widget
        $stats = [
            'pending' => Konseling::where('psikolog_id', $psikologId)->where('status', 'pending')->count(),
            'confirmed' => Konseling::where('psikolog_id', $psikologId)->where('status', 'confirmed')->count(),
            'completed' => Konseling::where('psikolog_id', $psikologId)->where('status', 'completed')->count(),
        ];

        // Kita akan buat view ini di Langkah 3
        return view('psikolog.dashboard', compact('konselings', 'stats'));
    }

    /**
     * Menampilkan form edit untuk Psikolog.
     * Form ini DIBATASI, hanya untuk update status.
     */
    public function edit(Konseling $konseling)
    {
        // Keamanan: Pastikan psikolog ini hanya mengedit jadwal miliknya
        if ($konseling->psikolog_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Kita akan buat view ini di Langkah 3
        return view('psikolog.edit-sesi', compact('konseling'));
    }

    /**
     * Update status booking oleh Psikolog.
     */
    public function update(Request $request, Konseling $konseling)
    {
        // Keamanan: Pastikan psikolog ini hanya mengupdate jadwal miliknya
        if ($konseling->psikolog_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi Ketat: Psikolog HANYA boleh ubah status.
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                Rule::in(['confirmed', 'completed', 'cancelled']), // Psikolog tidak bisa set 'pending'
            ]
        ]);

        // (Kita bisa tambahkan logika kirim email di sini nanti)

        $konseling->update($validated);

        return redirect()->route('psikolog.dashboard')->with('success', 'Status jadwal berhasil diperbarui.');
    }
}
