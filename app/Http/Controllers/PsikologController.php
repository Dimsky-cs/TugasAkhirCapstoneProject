<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PsikologController extends Controller
{
    public function index(Request $request) // <-- Tambahkan Request $request
    {
        $psikologId = Auth::id();

        // 1. Ambil Parameter
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'consultation_date');
        $sortDir = $request->input('sort_direction', 'desc');

        // 2. Query Dasar (Milik Psikolog ini)
        $query = Konseling::with('user') // Eager load user (klien)
            ->where('psikolog_id', $psikologId);

        // 3. Logika Pencarian (Cari Nama Klien)
        if ($search) {
            $query->where(function($q) use ($search) {
                // Cari berdasarkan nama klien di tabel users
                $q->whereHas('user', function($subQ) use ($search) {
                    $subQ->where('name', 'like', "%{$search}%");
                })
                ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // 4. Logika Sorting
        $allowedSorts = ['consultation_date', 'status'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('consultation_date', 'desc');
        }

        // 5. Pagination
        $konselings = $query->paginate(10)->appends($request->all());

        // Hitung statistik (tetap sama)
        $stats = [
            'pending' => Konseling::where('psikolog_id', $psikologId)->where('status', 'pending')->count(),
            'confirmed' => Konseling::where('psikolog_id', $psikologId)->where('status', 'confirmed')->count(),
            'completed' => Konseling::where('psikolog_id', $psikologId)->where('status', 'completed')->count(),
        ];

        return view('psikolog.dashboard', compact('konselings', 'stats'));
    }

    public function edit(Konseling $konseling)
    {
        if ($konseling->psikolog_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }
        return view('psikolog.edit-sesi', compact('konseling'));
    }

    /**
     * UPDATE LOGIC: Menangani Link Meeting & Notes
     */
    public function update(Request $request, Konseling $konseling)
    {
        // 1. Keamanan
        if ($konseling->psikolog_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // 2. Validasi Dasar
        $rules = [
            'status' => ['required', 'string', Rule::in(['confirmed', 'completed', 'cancelled'])],
        ];

        // 3. Validasi Kondisional (Logika Cerdas)

        // Jika status diubah jadi CONFIRMED, link meeting WAJIB diisi (kecuali offline/chat)
        if ($request->status === 'confirmed') {
            $rules['meeting_link'] = 'required|url';
        }

        // Jika status diubah jadi COMPLETED, notes boleh diisi
        if ($request->status === 'completed') {
            $rules['psikolog_notes'] = 'nullable|string';
        }

        $validated = $request->validate($rules, [
            'meeting_link.required' => 'Anda wajib menyertakan Link Meeting (Google Meet/Zoom) saat menerima jadwal.',
            'meeting_link.url' => 'Format link tidak valid. Harap masukkan URL lengkap (https://...).'
        ]);

        // 4. Simpan Data
        $konseling->update($validated);

        return redirect()->route('psikolog.dashboard')->with('success', 'Jadwal berhasil diperbarui.');
    }
}
