<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmed;

class KonselingController extends Controller
{
    /**
     * READ: Menampilkan daftar semua data konseling dengan Search, Filter, & Sorting.
     */
    public function index(Request $request)
    {
        // 1. Ambil Parameter
        $search = $request->input('search');
        $status = $request->input('status'); // <--- [BARU] Ambil filter status
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_direction', 'desc');

        // 2. Query Dasar
        $query = Konseling::with(['user', 'psikolog']);

        // 3. Logika Search
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

        // 4. [BARU] Logika Filter Status
        if ($status) {
            $query->where('status', $status);
        }

        // 5. Logika Sorting
        $allowedSorts = ['created_at', 'consultation_date', 'status', 'user_id'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // 6. Pagination (Append agar filter tidak hilang saat pindah halaman)
        $konselings = $query->paginate(10)->appends($request->all());

        return view('admin.konseling.index', compact('konselings'));
    }

    // ... (Method create, store, edit, update, destroy TETAP SAMA, tidak perlu diubah) ...

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $psikologs = User::where('role', 'psikolog')->get();
        return view('admin.konseling.create', compact('users', 'psikologs'));
    }

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

        $existingBooking = Konseling::where('psikolog_id', $validated['psikolog_id'])
            ->where('consultation_date', $validated['consultation_date'])
            ->where('consultation_time', $validated['consultation_time'])
            ->exists();

        if ($validated['psikolog_id'] && $existingBooking) {
            return back()->withErrors(['consultation_date' => 'Jadwal pada tanggal dan jam ini dengan psikolog tersebut sudah terisi.'])->withInput();
        }

        Konseling::create($validated);

        return redirect()->route('admin.konseling.index')->with('success', 'Jadwal konseling baru berhasil ditambahkan.');
    }

    public function edit(Konseling $konseling)
    {
        $users = User::where('role', 'user')->get();
        $psikologs = User::where('role', 'psikolog')->get();
        return view('admin.konseling.edit', compact('konseling', 'users', 'psikologs'));
    }

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

        $existingBooking = Konseling::where('psikolog_id', $validated['psikolog_id'])
            ->where('consultation_date', $validated['consultation_date'])
            ->where('consultation_time', $validated['consultation_time'])
            ->where('id', '!=', $konseling->id)
            ->exists();

        if ($validated['psikolog_id'] && $existingBooking) {
            return back()->withErrors(['consultation_date' => 'Jadwal bentrok.'])->withInput();
        }

        $konseling->update($validated);

        return redirect()->route('admin.konseling.index')->with('success', 'Data konseling berhasil diperbarui.');
    }

    public function destroy(Konseling $konseling)
    {
        $konseling->delete();
        return redirect()->route('admin.konseling.index')->with('success', 'Data konseling berhasil dihapus.');
    }
}
