<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\FuelType;
use App\Models\Spbu;
use App\Models\SuratJalan;
use App\Models\Distribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user->spbu_id) {
            return redirect()->route('login')->with('error', 'Akun Anda tidak terasosiasi dengan SPBU manapun.');
        }

        $spbu = $user->spbu;
        $ordersCount = Pesanan::where('spbu_id', $spbu->id)->count();
        $pendingCount = Pesanan::where('spbu_id', $spbu->id)->where('status', 'menunggu')->count();
        $deliveryCount = Pesanan::where('spbu_id', $spbu->id)->where('status', 'dikirim')->count();
        $completedCount = Pesanan::where('spbu_id', $spbu->id)->where('status', 'selesai')->count();

        // Recent orders
        $recentOrders = Pesanan::with(['fuelType', 'suratJalan.driver'])
            ->where('spbu_id', $spbu->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Active delivery (on progress)
        $activeDeliveries = SuratJalan::with(['driver', 'fuelType'])
            ->where('spbu_id', $spbu->id)
            ->where('status', 'dikirim')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('spbu.dashboard', compact(
            'spbu',
            'ordersCount',
            'pendingCount',
            'deliveryCount',
            'completedCount',
            'recentOrders',
            'activeDeliveries'
        ));
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user->spbu_id) {
            return redirect()->route('login')->with('error', 'Akun Anda tidak terasosiasi dengan SPBU manapun.');
        }

        $spbu = $user->spbu;
        $fuelTypes = FuelType::all();

        $orders = Pesanan::with(['fuelType', 'suratJalan'])
            ->where('spbu_id', $spbu->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('spbu.orders.index', compact('spbu', 'fuelTypes', 'orders'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->spbu_id) {
            return redirect()->route('login')->with('error', 'Akun Anda tidak terasosiasi dengan SPBU manapun.');
        }

        $validated = $request->validate([
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'volume_liter' => 'required|integer|min:1',
        ]);

        Pesanan::create([
            'kode_pesanan' => Pesanan::generateKode(),
            'spbu_id' => $user->spbu_id,
            'fuel_type_id' => $validated['fuel_type_id'],
            'volume_liter' => $validated['volume_liter'],
            'status' => 'menunggu',
            'created_by' => $user->id,
        ]);

        return redirect()->route('spbu.orders.index')->with('success', 'Pesanan BBM berhasil diajukan dan sedang menunggu persetujuan Admin Pusat.');
    }

    public function showScanPage()
    {
        $user = Auth::user();
        if (!$user->spbu_id) {
            return redirect()->route('login')->with('error', 'Akun Anda tidak terasosiasi dengan SPBU manapun.');
        }
        $spbu = $user->spbu;
        return view('spbu.verify.scan', compact('spbu'));
    }

    public function verifyBarcode(Request $request)
    {
        $user = Auth::user();
        if (!$user->spbu_id) {
            return response()->json(['success' => false, 'message' => 'Akun Anda tidak terasosiasi dengan SPBU.'], 403);
        }

        $validated = $request->validate([
            'barcode' => 'required|string',
        ]);

        $barcode = $validated['barcode'];

        // Find SuratJalan by barcode (kode_surat_jalan)
        $suratJalan = SuratJalan::with(['driver', 'fuelType', 'pesanan'])
            ->where('kode_surat_jalan', $barcode)
            ->first();

        if (!$suratJalan) {
            return response()->json(['success' => false, 'message' => 'Surat Jalan tidak ditemukan.'], 404);
        }

        // Verify destination SPBU matches this admin's SPBU
        if ($suratJalan->spbu_id !== $user->spbu_id) {
            return response()->json(['success' => false, 'message' => 'Tujuan Surat Jalan ini bukan SPBU Anda.'], 403);
        }

        // Check if the current status is indeed "dikirim"
        if ($suratJalan->status !== 'dikirim') {
            return response()->json(['success' => false, 'message' => 'Surat Jalan ini tidak sedang dalam pengiriman. Status saat ini: ' . $suratJalan->status], 400);
        }

        // Proceed to complete delivery
        DB::beginTransaction();
        try {
            // Update SuratJalan
            $suratJalan->update([
                'status' => 'selesai',
                'completed_at' => now(),
            ]);

            // Update associated Pesanan (if exists)
            if ($suratJalan->pesanan_id) {
                $suratJalan->pesanan->update([
                    'status' => 'selesai',
                ]);
            }

            // Create new Distribution record (completing the distribution flow)
            Distribution::create([
                'distribution_code' => Distribution::generateCode(),
                'qr_code_id' => null,
                'operator_id' => $suratJalan->driver_id,
                'spbu_id' => $suratJalan->spbu_id,
                'fuel_type_id' => $suratJalan->fuel_type_id,
                'vehicle_plate' => strtoupper($suratJalan->vehicle_plate),
                'driver_name' => $suratJalan->driver ? $suratJalan->driver->name : 'Driver',
                'volume_liter' => $suratJalan->volume_liter,
                'status' => 'selesai',
                'notes' => 'Diterima oleh Admin SPBU ' . $user->spbu->name . ' dan diverifikasi dengan pemindaian Barcode driver.',
                'surat_jalan_id' => $suratJalan->id,
                'distributed_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pengiriman BBM dengan Surat Jalan ' . $suratJalan->kode_surat_jalan . ' berhasil diterima dan diselesaikan!',
                'data' => [
                    'kode_surat_jalan' => $suratJalan->kode_surat_jalan,
                    'driver' => $suratJalan->driver ? $suratJalan->driver->name : '-',
                    'fuel_type' => $suratJalan->fuelType ? $suratJalan->fuelType->name : '-',
                    'volume' => $suratJalan->volume_liter,
                    'vehicle_plate' => $suratJalan->vehicle_plate,
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function superadminIndex(Request $request)
    {
        $query = Pesanan::with(['spbu', 'fuelType', 'suratJalan'])
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => Pesanan::count(),
            'menunggu' => Pesanan::where('status', 'menunggu')->count(),
            'disetujui' => Pesanan::where('status', 'disetujui')->count(),
            'dikirim' => Pesanan::where('status', 'dikirim')->count(),
            'selesai' => Pesanan::where('status', 'selesai')->count(),
            'ditolak' => Pesanan::where('status', 'ditolak')->count(),
        ];

        return view('superadmin.orders.index', compact('orders', 'stats'));
    }

    public function superadminReject(Pesanan $pesanan)
    {
        if ($pesanan->status !== 'menunggu') {
            return back()->with('error', 'Pesanan ini sudah diproses.');
        }

        $pesanan->update(['status' => 'ditolak']);
        return back()->with('success', 'Pesanan BBM berhasil ditolak.');
    }
}
