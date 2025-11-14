<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- [PENTING] Tambahkan ini
use Carbon\Carbon; // <-- [PENTING] Tambahkan ini

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. LOGIKA STAT CARDS (5 KARTU) ---
        $totalPengguna = User::where('role', 'user')->count();
        $totalPsikolog = User::where('role', 'psikolog')->count(); // <-- KARTU BARU
        $totalBooking = Konseling::count();
        $bookingPending = Konseling::where('status', 'pending')->count();
        $sesiSelesai = Konseling::where('status', 'completed')->count();

        // Kumpulkan data stats
        $stats = [
            'totalPengguna' => $totalPengguna,
            'totalPsikolog' => $totalPsikolog,
            'totalBooking' => $totalBooking,
            'bookingPending' => $bookingPending,
            'sesiSelesai' => $sesiSelesai,
        ];

        // --- 2. LOGIKA TABEL "PERLU KONFIRMASI" (Sama seperti sebelumnya) ---
        $konselingsPending = Konseling::with('user', 'psikolog')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->limit(5) // Ambil 5 terbaru
            ->get();


        // --- 3. [BARU] LOGIKA CHART TREN BOOKING (7 HARI TERAKHIR) ---
        $bookingData = Konseling::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Siapkan array untuk chart
        $chartBookingLabels = $bookingData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M'); // Format: "14 Nov"
        });
        $chartBookingData = $bookingData->pluck('total');


        // --- 4. [BARU] LOGIKA CHART LAYANAN POPULER (PIE CHART) ---
        $layananData = Konseling::select('service_type', DB::raw('count(*) as total'))
            ->groupBy('service_type')
            ->get();

        $chartLayananLabels = $layananData->pluck('service_type')->map(function ($layanan) {
            return ucfirst($layanan); // Format: "Karier", "Stres"
        });
        $chartLayananData = $layananData->pluck('total');


        // --- 5. KIRIM SEMUA DATA KE VIEW ---
        return view('admin.dashboard', compact(
            'stats',
            'konselingsPending',
            'chartBookingLabels',
            'chartBookingData',
            'chartLayananLabels',
            'chartLayananData'
        ));
    }
}
