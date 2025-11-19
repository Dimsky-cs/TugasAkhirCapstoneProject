<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konseling;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. STAT CARDS ---
        $stats = [
            'totalPengguna' => User::where('role', 'user')->count(),
            'totalPsikolog' => User::where('role', 'psikolog')->count(),
            'totalBooking' => Konseling::count(),
            'bookingPending' => Konseling::where('status', 'pending')->count(),
            'sesiSelesai' => Konseling::where('status', 'completed')->count(),
        ];

        // --- 2. TABEL PENDING (5 Terbaru) ---
        $konselingsPending = Konseling::with('user', 'psikolog')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        // --- 3. CHART 1: TREN BOOKING (Line Chart) ---
        // Mengambil data 7 hari terakhir
        $bookingData = Konseling::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartBookingLabels = $bookingData->map(fn($item) => Carbon::parse($item->date)->format('d M'));
        $chartBookingData = $bookingData->pluck('total');

        // --- 4. CHART 2: LAYANAN TERPOPULER (Pie Chart) ---
        $layananData = Konseling::select('service_type', DB::raw('count(*) as total'))
            ->groupBy('service_type')
            ->get();

        $chartLayananLabels = $layananData->pluck('service_type')->map(fn($val) => ucfirst($val));
        $chartLayananData = $layananData->pluck('total');

        // --- [BARU] CHART 3: METODE SESI FAVORIT (Bar Chart Horizontal) ---
        // Menghitung Video Call vs Chat vs Voice Call
        $methodData = Konseling::select('session_preference', DB::raw('count(*) as total'))
            ->whereNotNull('session_preference')
            ->groupBy('session_preference')
            ->orderByDesc('total')
            ->get();

        $chartMethodLabels = $methodData->pluck('session_preference');
        $chartMethodData = $methodData->pluck('total');

        // --- [BARU] CHART 4: HARI TERSIBUK (Column/Bar Chart Vertical) ---
        // Melihat hari apa yang paling banyak jadwal konselingnya
        $dayData = Konseling::select(DB::raw('DAYNAME(consultation_date) as day'), DB::raw('count(*) as total'))
            ->groupBy('day')
            // Trik MySQL untuk mengurutkan hari Senin s/d Minggu
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();

        // Translate hari ke Indonesia (Opsional, manual mapping agar rapi)
        $indoDays = [
            'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'
        ];

        $chartDayLabels = $dayData->map(fn($item) => $indoDays[$item->day] ?? $item->day);
        $chartDayData = $dayData->pluck('total');

        return view('admin.dashboard', compact(
            'stats', 'konselingsPending',
            'chartBookingLabels', 'chartBookingData',
            'chartLayananLabels', 'chartLayananData',
            'chartMethodLabels', 'chartMethodData',
            'chartDayLabels', 'chartDayData'
        ));
    }
}
