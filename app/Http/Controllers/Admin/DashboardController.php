<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Konseling;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data statistik.
     */
    public function index()
    {
        // Menghitung total pengguna dengan role 'user'
        $totalUsers = User::where('role', 'user')->count();

        // Menghitung total booking
        $totalBookings = Konseling::count();

        // Menghitung booking yang masih pending
        $pendingBookings = Konseling::where('status', 'pending')->count();

        // Menghitung booking yang sudah selesai
        $completedBookings = Konseling::where('status', 'completed')->count();

        // Mengambil 5 booking terbaru yang statusnya pending untuk ditampilkan di tabel
        $recentBookings = Konseling::where('status', 'pending')
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();

        // Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBookings',
            'pendingBookings',
            'completedBookings',
            'recentBookings'
        ));
    }
}

