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
        // 1. Statistik Utama
        $stats = [
            'totalPengguna' => User::where('role', 'user')->count(),
            'totalPsikolog' => User::where('role', 'psikolog')->count(),
            'totalBooking' => Konseling::count(),
            'bookingPending' => Konseling::where('status', 'pending')->count(),
            'sesiSelesai' => Konseling::where('status', 'completed')->count(),
        ];

        // 2. Tabel Pending (5 Terbaru)
        $konselingsPending = Konseling::with('user', 'psikolog')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        // 3. [UPDATE] CHART 1: TREN BOOKING (BULANAN)
        // Hanya mengambil data di bulan dan tahun saat ini
        $bookingData = Konseling::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Format label tanggal (contoh: 01 Nov, 02 Nov)
        $chartBookingLabels = $bookingData->map(fn($item) => Carbon::parse($item->date)->format('d M'));
        $chartBookingData = $bookingData->pluck('total');

        // 4. Chart Lainnya
        $layananData = Konseling::select('service_type', DB::raw('count(*) as total'))
            ->groupBy('service_type')->get();
        $chartLayananLabels = $layananData->pluck('service_type')->map(fn($val) => ucfirst($val));
        $chartLayananData = $layananData->pluck('total');

        $metodeData = Konseling::select('session_preference', DB::raw('count(*) as total'))
            ->whereNotNull('session_preference')->groupBy('session_preference')->orderByDesc('total')->get();
        $chartMetodeLabels = $metodeData->pluck('session_preference');
        $chartMetodeData = $metodeData->pluck('total');

        $hariData = Konseling::select(DB::raw('DAYNAME(consultation_date) as day'), DB::raw('count(*) as total'))
            ->whereNotNull('consultation_date')->groupBy('day')
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")->get();

        $mapHari = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'];
        $chartHariLabels = $hariData->map(fn($item) => $mapHari[$item->day] ?? $item->day);
        $chartHariData = $hariData->pluck('total');

        // Kirim nama bulan saat ini untuk judul grafik
        $currentMonth = Carbon::now()->isoFormat('MMMM Y');

        return view('admin.dashboard', compact(
            'stats', 'konselingsPending',
            'chartBookingLabels', 'chartBookingData',
            'chartLayananLabels', 'chartLayananData',
            'chartMetodeLabels', 'chartMetodeData',
            'chartHariLabels', 'chartHariData',
            'currentMonth'
        ));
    }
}
