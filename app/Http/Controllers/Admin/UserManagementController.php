<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    /**
     * Menampilkan daftar user dengan Fitur Search, Filter, dan Sorting.
     */
    public function index(Request $request)
    {
        // 1. Ambil Parameter dari URL
        $search = $request->input('search');
        $role = $request->input('role');
        $sortBy = $request->input('sort_by', 'created_at'); // Default: Tanggal Gabung
        $sortDir = $request->input('sort_direction', 'desc'); // Default: Terbaru

        // 2. Query Dasar
        $query = User::query();

        // 3. Logika SEARCH (Pencarian)
        $query->when($search, function ($q) use ($search) {
            $q->where(function($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
            });
        });

        // 4. Logika FILTER (Role)
        $query->when($role, function ($q) use ($role) {
            $q->where('role', $role);
        });

        // 5. Logika SORTING (Pengurutan) - INI YANG KURANG SEBELUMNYA
        $allowedSorts = ['name', 'email', 'role', 'created_at']; // Kolom yang diizinkan

        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('created_at', 'desc'); // Fallback default
        }

        // 6. Ambil Data + Pagination
        // Gunakan appends() agar parameter search/sort tidak hilang saat pindah halaman
        $users = $query->paginate(10)->appends($request->all());

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $specialtiesList = ['Kecemasan', 'Karier', 'Hubungan', 'Stres', 'Depresi'];
        return view('admin.users.create', compact('specialtiesList'));
    }

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
            'specialties' => $validated['role'] === 'psikolog' ? ($validated['specialties'] ?? []) : null,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User baru berhasil dibuat.');
    }

    public function edit(User $user)
    {
        $specialtiesList = ['Kecemasan', 'Karier', 'Hubungan', 'Stres', 'Depresi'];
        return view('admin.users.edit', compact('user', 'specialtiesList'));
    }

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

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Handle specialties: Jika psikolog, simpan array. Jika bukan, null.
        if ($validated['role'] === 'psikolog') {
            $user->specialties = $validated['specialties'] ?? [];
        } else {
            $user->specialties = null;
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
