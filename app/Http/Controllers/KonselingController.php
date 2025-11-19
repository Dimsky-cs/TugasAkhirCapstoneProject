<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KonselingController extends Controller
{
    /**
     * Menampilkan riwayat konseling milik user yang sedang login.
     */
    public function index(Request $request) // <-- Pastikan ada Request $request
    {
        // 1. Ambil Parameter dari URL (Default: Urutkan tanggal terbaru)
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'consultation_date');
        $sortDir = $request->input('sort_direction', 'desc');

        // 2. Query Dasar (Milik User yang Login)
        $query = Konseling::with('psikolog')->where('user_id', Auth::id());

        // 3. Logika PENCARIAN (Searching)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('service_type', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('psikolog', function($subQ) use ($search) {
                      $subQ->where('name', 'like', "%{$search}%"); // Cari nama psikolog
                  });
            });
        }

        // 4. Logika PENGURUTAN (Sorting)
        // Kita batasi kolom apa saja yang boleh disortir agar aman
        $allowedSorts = ['consultation_date', 'status', 'service_type', 'created_at'];

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('consultation_date', 'desc');
        }

        // 5. Pagination (Penting: appends agar filter tidak hilang saat ganti halaman)
        $konselings = $query->paginate(10)->appends($request->all());

        return view('user.konseling-index', compact('konselings'));
    }

    /**
     * Menampilkan form untuk membuat jadwal konseling baru.
     */
    public function create()
    {
        return view('user.konseling-create');
    }

    /**
     * Menyimpan data booking baru dari form.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'client_phone' => [
                'required',
                'string',
                'regex:/^(\+62|0)8[1-9][0-9]{7,11}$/'
            ],
            'service_type' => 'required|string|max:255',
            'psikolog_id' => 'required|exists:users,id',
            'session_preference' => 'required|string|in:Video Call,Voice Call,Chat Saja',
            'consultation_date' => 'required|date|after_or_equal:today',
            'consultation_time' => 'required',
            'description' => 'nullable|string',
        ], [
            'client_phone.regex' => 'Format nomor telepon tidak valid. Gunakan format 08... atau +628...'
        ]);

        // 2. Cek Jadwal Bentrok
        $existingBooking = Konseling::where('psikolog_id', $request->psikolog_id)
            ->where('consultation_date', $request->consultation_date)
            ->where('consultation_time', $request->consultation_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['consultation_time' => 'Jadwal pada tanggal dan jam tersebut dengan psikolog ini sudah terisi.'])->withInput();
        }

        // 3. Simpan Data
        Konseling::create([
            'user_id' => Auth::id(),
            'client_name' => Auth::user()->name,
            'client_email' => Auth::user()->email,
            'client_phone' => $request->client_phone,
            'service_type' => $request->service_type,
            'psikolog_id' => $request->psikolog_id,
            'session_preference' => $request->session_preference,
            'consultation_date' => $request->consultation_date,
            'consultation_time' => $request->consultation_time,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('user.konseling.index')->with('success', 'Jadwal konseling Anda berhasil dibuat dan sedang menunggu konfirmasi.');
    }

    // --- BAGIAN BARU: LOGIKA REVIEW & RATING ---
    // (Pastikan fungsi ini ada DI DALAM kurung kurawal class)

    /**
     * Menampilkan form ulasan untuk sesi yang sudah selesai.
     */
    public function showReviewForm(Konseling $konseling)
    {
        // Keamanan 1: Pastikan ini milik user yang login
        if ($konseling->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Keamanan 2: Pastikan statusnya SUDAH SELESAI
        if ($konseling->status !== 'completed') {
            return redirect()->route('user.konseling.index')->with('error', 'Anda hanya bisa memberi ulasan pada sesi yang sudah selesai.');
        }

        // Keamanan 3: Pastikan belum pernah direview sebelumnya
        if ($konseling->rating) {
            return redirect()->route('user.konseling.index')->with('error', 'Anda sudah memberikan ulasan untuk sesi ini.');
        }

        return view('user.konseling-review', compact('konseling'));
    }

    /**
     * Menyimpan data rating dan review ke database.
     */
    public function storeReview(Request $request, Konseling $konseling)
    {
        // Validasi keamanan ulang
        if ($konseling->user_id !== Auth::id() || $konseling->status !== 'completed') {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        $konseling->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('user.konseling.index')->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }

} // <--- TUTUP KURUNG KURAWAL CLASS HARUS DI SINI (PALING BAWAH)
