<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF; // Alias dari DomPDF
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KonselingExport; // Kita akan buat file ini di Langkah 2

class ReportController extends Controller
{
    /**
     * Logika utama untuk mengambil data berdasarkan ROLE.
     */
    private function getDataBasedOnRole()
    {
        $user = Auth::user();
        $query = Konseling::with(['user', 'psikolog']); // Eager load relasi

        // FILTER LOGIC
        switch ($user->role) {
            case 'admin':
                // Admin ambil semua data, urutkan terbaru
                return $query->orderBy('consultation_date', 'desc')->get();

            case 'psikolog':
                // Psikolog hanya ambil jadwal yang ditugaskan ke dia
                return $query->where('psikolog_id', $user->id)
                             ->orderBy('consultation_date', 'desc')
                             ->get();

            case 'user':
                // User hanya ambil riwayat dia sendiri
                return $query->where('user_id', $user->id)
                             ->orderBy('consultation_date', 'desc')
                             ->get();

            default:
                return collect([]); // Kosong jika role tidak jelas
        }
    }

    public function exportPDF()
    {
        $data = $this->getDataBasedOnRole();
        $role = Auth::user()->role;
        $date = date('d-m-Y');

        // Load view khusus PDF
        $pdf = PDF::loadView('exports.laporan_pdf', compact('data', 'role', 'date'));

        // Set ukuran kertas (opsional)
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download("Laporan_Konseling_{$role}_{$date}.pdf");
    }

    public function exportExcel()
    {
        $data = $this->getDataBasedOnRole();
        $role = Auth::user()->role;
        $date = date('d-m-Y');

        // Menggunakan Class Export terpisah (Langkah 2)
        return Excel::download(new KonselingExport($data), "Laporan_Konseling_{$role}_{$date}.xlsx");
    }
}
