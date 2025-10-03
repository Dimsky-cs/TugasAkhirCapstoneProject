<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class KonselingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $konselings = Konseling::where('user_id', Auth::id())->latest()->paginate(5);
        return view('user.konseling-index', compact('konselings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Titik koma ditambahkan di sini
        return view('user.konseling-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input, termasuk data klien
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'service_type' => 'required|string',
            'consultation_date' => 'required|date|after_or_equal:today',
            'consultation_time' => [
                'required',
                // Rule ini mengecek apakah kombinasi tanggal & waktu sudah ada
                Rule::unique('konselings')->where(function ($query) use ($request) {
                    return $query->where('consultation_date', $request->consultation_date)
                                 ->where('consultation_time', $request->consultation_time);
                }),
            ],
            'description' => 'nullable|string|max:1000',
        ], [
            // Pesan error kustom dalam Bahasa Indonesia
            'consultation_time.unique' => 'Maaf, jadwal pada tanggal dan jam tersebut sudah terisi. Silakan pilih waktu lain.',
            'client_name.required' => 'Nama lengkap wajib diisi.',
            'client_email.required' => 'Alamat email wajib diisi.',
            'client_phone.required' => 'Nomor telepon wajib diisi.',
            'service_type.required' => 'Jenis layanan wajib diisi.',
            'consultation_date.required' => 'Tanggal konsultasi wajib diisi.',
            'consultation_date.after_or_equal' => 'Tanggal konsultasi tidak boleh hari yang sudah lewat.',
            'consultation_time.required' => 'Waktu konsultasi wajib diisi.',
        ]);

        // 2. Buat instance model dan isi datanya
        $konseling = new Konseling();
        $konseling->user_id = Auth::id(); // User yang melakukan booking
        $konseling->client_name = $validated['client_name'];
        $konseling->client_email = $validated['client_email'];
        $konseling->client_phone = $validated['client_phone'];
        $konseling->service_type = $validated['service_type'];
        $konseling->consultation_date = $validated['consultation_date'];
        $konseling->consultation_time = $validated['consultation_time'];
        $konseling->description = $validated['description'];
        
        // 3. Simpan ke Database
        $konseling->save();

        // 4. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('user.konseling.index')->with('success', 'Booking konseling Anda telah berhasil dibuat!');
    }
}

