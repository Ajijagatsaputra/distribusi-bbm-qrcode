<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Distribution;
use App\Models\QrCode;
use App\Models\Spbu;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('spbu')->orderBy('role')->orderBy('name')->get();
        $stats = [
            'admin_pusat' => $users->where('role', 'admin_pusat')->count(),
            'admin_depo' => $users->where('role', 'admin_depo')->count(),
            'driver' => $users->where('role', 'driver')->count(),
            'admin_spbu' => $users->where('role', 'admin_spbu')->count(),
            'total' => $users->count(),
        ];
        $spbus = Spbu::where('status', 'aktif')->orderBy('name')->get();
        return view('superadmin.users-management', compact('users', 'stats', 'spbus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => ['required', Rule::in(['admin_pusat', 'admin_depo', 'driver', 'admin_spbu'])],
            'password' => 'required|min:6',
            'spbu_id' => 'required_if:role,admin_spbu|nullable|exists:spbus,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'is_active' => true,
            'spbu_id' => $validated['role'] === 'admin_spbu' ? $validated['spbu_id'] : null,
        ]);

        return redirect()->route('superadmin.users-management')
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['admin_pusat', 'admin_depo', 'driver', 'admin_spbu'])],
            'spbu_id' => 'required_if:role,admin_spbu|nullable|exists:spbus,id',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'spbu_id' => $validated['role'] === 'admin_spbu' ? $validated['spbu_id'] : null,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('superadmin.users-management')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        return response()->json(['is_active' => $user->is_active]);
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        try {
            $user->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for foreign key integrity constraint violation
            if ($e->getCode() === '23000') {
                return back()->with('error', 'Tidak dapat menghapus pengguna ini karena memiliki riwayat transaksi/aktivitas dalam sistem. Silakan nonaktifkan status akunnya saja.');
            }
            throw $e;
        }

        return redirect()->route('superadmin.users-management')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
