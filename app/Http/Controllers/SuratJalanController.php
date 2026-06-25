<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\User;
use App\Models\Spbu;
use App\Models\FuelType;
use App\Models\Distribution;
use App\Models\QrCode;
use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    // ── ADMIN PUSAT: Kelola Surat Jalan ───────────────────────────────

    /** Daftar semua surat jalan */
    public function index(Request $request)
    {
        $query = SuratJalan::with(['driver', 'spbu', 'fuelType', 'createdBy'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($q2) use ($q) {
                $q2->where('kode_surat_jalan', 'like', "%$q%")
                    ->orWhere('vehicle_plate', 'like', "%$q%")
                    ->orWhereHas('driver', fn($r) => $r->where('name', 'like', "%$q%"));
            });
        }

        $suratJalans = $query->paginate(15)->withQueryString();
        $stats = [
            'total' => SuratJalan::count(),
            'menunggu' => SuratJalan::where('status', 'menunggu')->count(),
            'terverifikasi' => SuratJalan::where('status', 'terverifikasi')->count(),
            'dikirim' => SuratJalan::where('status', 'dikirim')->count(),
            'selesai' => SuratJalan::where('status', 'selesai')->count(),
        ];

        return view('superadmin.surat-jalan', compact('suratJalans', 'stats'));
    }

    /** Form buat surat jalan baru */
    public function create()
    {
        $drivers = User::where('role', 'driver')->where('is_active', true)->orderBy('name')->get();
        $spbus = Spbu::where('status', 'aktif')->orderBy('name')->get();
        $fuelTypes = FuelType::where('status', 'aktif')->orderBy('name')->get();
        return view('superadmin.surat-jalan-create', compact('drivers', 'spbus', 'fuelTypes'));
    }

    /** Simpan surat jalan baru */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
            'spbu_id' => 'required|exists:spbus,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'volume_liter' => 'required|integer|min:100',
            'vehicle_plate' => 'required|string|max:15',
            'tanggal_kirim' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string|max:500',
        ]);

        SuratJalan::create(array_merge($validated, [
            'kode_surat_jalan' => SuratJalan::generateKode(),
            'status' => 'menunggu',
            'created_by' => auth()->id(),
        ]));

        return redirect()->route('superadmin.surat-jalan.index')
            ->with('success', 'Surat Jalan berhasil dibuat dan dikirim ke driver.');
    }

    /** Batalkan surat jalan */
    public function destroy(SuratJalan $suratJalan)
    {
        if (in_array($suratJalan->status, ['selesai', 'dikirim'])) {
            return back()->with('error', 'Surat Jalan tidak dapat dibatalkan karena sudah dalam proses pengiriman.');
        }
        $suratJalan->update(['status' => 'dibatalkan']);
        return back()->with('success', 'Surat Jalan berhasil dibatalkan.');
    }

    // ── ADMIN DEPO: Verifikasi Surat Jalan ───────────────────────────

    /** Daftar surat jalan yang perlu diverifikasi */
    public function depoIndex(Request $request)
    {
        $query = SuratJalan::with(['driver', 'spbu', 'fuelType'])
            ->whereIn('status', ['menunggu', 'terverifikasi', 'dikirim', 'selesai'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $suratJalans = $query->paginate(15)->withQueryString();
        $stats = [
            'menunggu' => SuratJalan::where('status', 'menunggu')->count(),
            'terverifikasi' => SuratJalan::where('status', 'terverifikasi')->count(),
            'dikirim' => SuratJalan::where('status', 'dikirim')->count(),
            'selesai' => SuratJalan::where('status', 'selesai')->count(),
        ];

        return view('admin.verifikasi-surat-jalan', compact('suratJalans', 'stats'));
    }

    /** Admin Depo: Verifikasi surat jalan (cocok dengan driver) */
    public function verify(SuratJalan $suratJalan)
    {
        if ($suratJalan->status !== 'menunggu') {
            return back()->with('error', 'Surat Jalan ini sudah diverifikasi.');
        }

        $suratJalan->update([
            'status' => 'terverifikasi',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return back()->with('success', "Surat Jalan {$suratJalan->kode_surat_jalan} berhasil diverifikasi. Driver siap berangkat.");
    }

    /** Admin Depo: Tandai surat jalan sedang dikirim */
    public function markDikirim(SuratJalan $suratJalan)
    {
        if ($suratJalan->status !== 'terverifikasi') {
            return back()->with('error', 'Surat Jalan harus diverifikasi terlebih dahulu.');
        }

        $suratJalan->update(['status' => 'dikirim']);
        return back()->with('success', "Driver {$suratJalan->driver->name} sudah berangkat menuju SPBU.");
    }

    // ── DRIVER: Lihat Surat Jalan Sendiri ────────────────────────────

    /** Driver: lihat surat jalan yang di-assign ke dia */
    public function driverIndex(Request $request)
    {
        $suratJalans = SuratJalan::with(['spbu', 'fuelType', 'createdBy'])
            ->where('driver_id', auth()->id())
            ->whereNotIn('status', ['dibatalkan'])
            ->latest()
            ->paginate(10);

        $active = SuratJalan::where('driver_id', auth()->id())
            ->whereIn('status', ['menunggu', 'terverifikasi', 'dikirim'])
            ->first();

        return view('operator.surat-jalan', compact('suratJalans', 'active'));
    }

    /** Driver: konfirmasi selesai dengan scan QR di SPBU */
    public function completeByDriver(Request $request, SuratJalan $suratJalan)
    {
        if ($suratJalan->driver_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        if ($suratJalan->status !== 'dikirim') {
            return response()->json(['success' => false, 'message' => 'Status tidak valid untuk dikonfirmasi.'], 422);
        }

        // Verifikasi QR token yang di-scan
        $request->validate(['token' => 'required|string']);
        $qrCode = \App\Models\QrCode::where('token', $request->token)
            ->where('status', 'aktif')
            ->first();

        if (!$qrCode) {
            return response()->json(['success' => false, 'message' => 'QR Code tidak valid atau sudah digunakan.'], 422);
        }

        // Tandai QR digunakan
        $qrCode->update(['status' => 'digunakan']);

        // Tandai surat jalan selesai
        $suratJalan->update([
            'status' => 'selesai',
            'completed_at' => now(),
        ]);

        // Buat data distribusi otomatis
        Distribution::create([
            'distribution_code' => Distribution::generateCode(),
            'qr_code_id' => $qrCode->id,
            'operator_id' => auth()->id(), // Driver yang mengonfirmasi
            'spbu_id' => $suratJalan->spbu_id,
            'fuel_type_id' => $suratJalan->fuel_type_id,
            'vehicle_plate' => strtoupper($suratJalan->vehicle_plate),
            'driver_name' => auth()->user()->name,
            'volume_liter' => $suratJalan->volume_liter,
            'status' => 'selesai',
            'notes' => 'Dikonfirmasi secara otomatis via Scan QR Code di SPBU.',
            'surat_jalan_id' => $suratJalan->id,
            'distributed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Distribusi BBM berhasil dikonfirmasi. Terima kasih!',
            'kode' => $suratJalan->kode_surat_jalan,
        ]);
    }
}
