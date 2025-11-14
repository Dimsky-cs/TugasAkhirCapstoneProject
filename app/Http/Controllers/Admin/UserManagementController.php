<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request; // <-- [PENTING] Tambahkan ini
use Illuminate\Support\Facades\Auth; // <-- [PENTING] Tambahkan ini
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    /**
     * Menampilkan daftar semua user (Read)
     * [VERSI BARU DENGAN FILTER DAN PENCARIAN]
     */
    public function index(Request $request) // <-- Tambahkan Request $request
    {
        // Ambil filter dari URL query
        $search = $request->query('search');
        $role = $request->query('role');

        // Mulai query
        $query = User::orderBy('name', 'asc');

        // Terapkan filter PENCARIAN jika ada
        $query->when($search, function ($q) use ($search) {
            // Cari di nama ATAU email
            $q->where(function($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
            });
        });

        // Terapkan filter ROLE jika ada
        $query->when($role, function ($q) use ($role) {
            $q->where('role', $role);
        });

        // Ambil hasilnya dengan pagination
        $users = $query->paginate(15)
                       ->appends($request->query()); // <-- [PENTING] Agar pagination tetap membawa filter

        return view('admin.users.index', compact('users', 'search', 'role'));
    }

    /**
     * Menampilkan form untuk membuat user baru (Create)
     */
    public function create()
    {
        // Definisikan daftar layanan/spesialisasi di sini
        $specialtiesList = ['karier', 'stres', 'hubungan', 'kecemasan'];
        return view('admin.users.create', compact('specialtiesList'));
    }

    /**
     * Menyimpan user baru ke database (Create)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required', Rule::in(['admin', 'psikolog', 'user'])],
            'specialties' => 'nullable|array',
            'specialties.*' => 'string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'specialties' => $validated['role'] === 'psikolog' ? $validated['specialties'] : null,
            'email_verified_at' => now(), // Anggap user buatan admin sudah terverifikasi
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit user (Update)
     */
    public function edit(User $user)
    {
        // Definisikan daftar layanan/spesialisasi di sini
        $specialtiesList = ['karier', 'stres', 'hubungan', 'kecemasan'];
        return view('admin.users.edit', compact('user', 'specialtiesList'));
    }

    /**
     * Memperbarui data user di database (Update)
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => ['required', Rule::in(['admin', 'psikolog', 'user'])],
            'specialties' => 'nullable|array',
            'specialties.*' => 'string',
        ]);

        // Update data dasar
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->specialties = $validated['role'] === 'psikolog' ? $validated['specialties'] : null;

        // Hanya update password JIKA diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database (Delete)
     */
    public function destroy(User $user)
    {
        // Tambahkan pengaman agar tidak bisa hapus diri sendiri
        if (Auth::id() === $user->id) {
            return back()->withErrors(['delete' => 'Anda tidak bisa menghapus akun Anda sendiri.']);
        }

        try {
             $user->delete();
             return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
             return back()->withErrors(['delete' => 'Gagal menghapus user. Mungkin user ini masih memiliki jadwal booking terkait.']);
        }
    }
}
