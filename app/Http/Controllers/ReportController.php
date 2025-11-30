<?php

namespace App\Http\Controllers;

use App\Models\Konseling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KonselingExport;

class ReportController extends Controller
{
    private function getDataBasedOnRole()
    {
        $user = Auth::user();
        $query = Konseling::with(['user', 'psikolog']);

        switch ($user->role) {
            case 'admin':
                return $query->orderBy('consultation_date', 'desc')->get();
            case 'psikolog':
                return $query->where('psikolog_id', $user->id)
                             ->orderBy('consultation_date', 'desc')
                             ->get();
            case 'user':
                return $query->where('user_id', $user->id)
                             ->orderBy('consultation_date', 'desc')
                             ->get();
            default:
                return collect([]);
        }
    }

    public function exportPDF()
    {
        $data = $this->getDataBasedOnRole();
        $role = Auth::user()->role;
        $date = date('d-m-Y');

        $pdf = PDF::loadView('exports.laporan_pdf', compact('data', 'role', 'date'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download("Laporan_Konseling_{$role}_{$date}.pdf");
    }

    public function exportExcel()
    {
        $data = $this->getDataBasedOnRole();
        $role = Auth::user()->role;
        $date = date('d-m-Y');

        return Excel::download(new KonselingExport($data), "Laporan_Konseling_{$role}_{$date}.xlsx");
    }
}