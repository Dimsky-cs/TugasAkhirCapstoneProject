<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use App\Models\User; // <-- [PENTING] Pastikan ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // (Jika kamu skip email, ini tidak apa-apa)
use App\Mail\BookingConfirmed; // (Jika kamu skip email, ini tidak apa-apa)

class KonselingController extends Controller
{
    /**
     * READ: Menampilkan daftar semua data konseling.
    */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_direction', 'desc');

        $query = Konseling::with(['user', 'psikolog']);

        // Search (Bisa cari nama Klien ATAU nama Psikolog)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($u) use ($search) {
                    $u->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('psikolog', function($p) use ($search) {
                    $p->where('name', 'like', "%{$search}%");
                })
                ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // Sorting
        $allowedSorts = ['created_at', 'consultation_date', 'status'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $konselings = $query->paginate(10)->appends($request->all());

        return view('admin.konseling.index', compact('konselings'));
    }

    /**
     * CREATE: Menampilkan form untuk membuat data baru.
     * [INI BAGIAN YANG DIPERBAIKI]
     */
    public function create()
    {
        $users = User::where('role', 'user')->get(); // Ambil daftar user
        $psikologs = User::where('role', 'psikolog')->get(); // <-- INI YANG HILANG

        return view('admin.konseling.create', compact('users', 'psikologs'));
    }

    /**
     * STORE: Menyimpan data baru dari form create ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'psikolog_id' => 'nullable|exists:users,id',
            'session_preference' => 'required|string|in:Video Call,Voice Call,Chat Saja',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'consultation_time' => 'required',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        // Cek jika jadwal sudah ada
        $existingBooking = Konseling::where('psikolog_id', $validated['psikolog_id'])
            ->where('consultation_date', $validated['consultation_date'])
            ->where('consultation_time', $validated['consultation_time'])
            ->exists();

        if ($validated['psikolog_id'] && $existingBooking) {
            return back()->withErrors(['consultation_date' => 'Jadwal pada tanggal dan jam ini dengan psikolog tersebut sudah terisi.'])->withInput();
        }

        $konseling = Konseling::create($validated);

        // (Logika email notifikasi akan ada di sini nanti)

        return redirect()->route('admin.konseling.index')->with('success', 'Jadwal konseling baru berhasil ditambahkan.');
    }

    /**
     * EDIT: Menampilkan form untuk mengedit data.
     * [INI JUGA PENTING]
     */
    public function edit(Konseling $konseling)
    {
        $users = User::where('role', 'user')->get();
        $psikologs = User::where('role', 'psikolog')->get();

        return view('admin.konseling.edit', compact('konseling', 'users', 'psikologs'));
    }

    /**
     * UPDATE: Memperbarui data di database.
     */
    public function update(Request $request, Konseling $konseling)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'psikolog_id' => 'nullable|exists:users,id',
            'session_preference' => 'required|string|in:Video Call,Voice Call,Chat Saja',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'service_type' => 'required|string|max:255',
            'consultation_date' => 'required|date',
            'consultation_time' => 'required',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        // Cek jadwal bentrok
        $existingBooking = Konseling::where('psikolog_id', $validated['psikolog_id'])
            ->where('consultation_date', $validated['consultation_date'])
            ->where('consultation_time', $validated['consultation_time'])
            ->where('id', '!=', $konseling->id) // Pengecualian
            ->exists();

        if ($validated['psikolog_id'] && $existingBooking) {
            return back()->withErrors(['consultation_date' => 'Jadwal pada tanggal dan jam ini dengan psikolog tersebut sudah terisi oleh booking lain.'])->withInput();
        }

        $konseling->update($validated);

        // (Logika email notifikasi akan ada di sini nanti)

        return redirect()->route('admin.konseling.index')->with('success', 'Data konseling berhasil diperbarui.');
    }

    /**
     * DELETE: Menghapus data dari database.
     */
    public function destroy(Konseling $konseling)
    {
        $konseling->delete();
        return redirect()->route('admin.konseling.index')->with('success', 'Data konseling berhasil dihapus.');
    }




}
