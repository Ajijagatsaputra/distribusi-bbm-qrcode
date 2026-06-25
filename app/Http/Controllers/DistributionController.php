<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use App\Models\QrCode;
use App\Models\Spbu;
use App\Models\FuelType;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /** Tampilkan form input distribusi */
    public function create()
    {
        $spbus = Spbu::where('status', 'aktif')->orderBy('name')->get();
        $fuelTypes = FuelType::where('status', 'aktif')->orderBy('name')->get();

        if (auth()->user()->role === 'admin_depo') {
            $suratJalans = SuratJalan::with(['driver', 'spbu', 'fuelType'])
                ->whereIn('status', ['terverifikasi', 'dikirim'])
                ->orderBy('kode_surat_jalan')
                ->get();
            $qrCodes = QrCode::where('status', 'aktif')->orderBy('qr_id')->get();
            return view('admin.input-distribusi', compact('spbus', 'fuelTypes', 'suratJalans', 'qrCodes'));
        }

        return view('operator.input-distribution', compact('spbus', 'fuelTypes'));
    }

    /** Simpan distribusi baru */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'surat_jalan_id' => 'nullable|exists:surat_jalans,id',
            'qr_code_id' => 'nullable|exists:qr_codes,id',
            'spbu_id' => 'required|exists:spbus,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'vehicle_plate' => 'required|string|max:15',
            'driver_name' => 'required|string|max:100',
            'volume_liter' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        // Mark QR as used if provided
        if (!empty($validated['qr_code_id'])) {
            QrCode::where('id', $validated['qr_code_id'])
                ->where('status', 'aktif')
                ->update(['status' => 'digunakan']);
        }

        // Link with Surat Jalan if provided
        if (!empty($validated['surat_jalan_id'])) {
            SuratJalan::where('id', $validated['surat_jalan_id'])
                ->update([
                    'status' => 'selesai',
                    'completed_at' => now(),
                ]);
        }

        Distribution::create([
            'distribution_code' => Distribution::generateCode(),
            'qr_code_id' => $validated['qr_code_id'] ?? null,
            'operator_id' => auth()->id(),
            'spbu_id' => $validated['spbu_id'],
            'fuel_type_id' => $validated['fuel_type_id'],
            'vehicle_plate' => strtoupper($validated['vehicle_plate']),
            'driver_name' => $validated['driver_name'],
            'volume_liter' => $validated['volume_liter'],
            'status' => 'selesai',
            'notes' => $validated['notes'] ?? 'Diinput secara manual oleh Admin Depo.',
            'surat_jalan_id' => $validated['surat_jalan_id'] ?? null,
            'distributed_at' => now(),
        ]);

        if (auth()->user()->role === 'admin_depo') {
            return redirect()->route('admin.distribution-data')
                ->with('success', 'Data distribusi manual berhasil disimpan!');
        }

        return redirect()->route('operator.history')
            ->with('success', 'Data distribusi berhasil disimpan!');
    }

    /** Operator: tampilkan history distribusinya sendiri */
    public function history(Request $request)
    {
        $query = Distribution::with(['spbu', 'fuelType'])
            ->where('operator_id', auth()->id())
            ->latest('distributed_at');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($q2) use ($q) {
                $q2->where('distribution_code', 'like', "%$q%")
                    ->orWhere('vehicle_plate', 'like', "%$q%")
                    ->orWhere('driver_name', 'like', "%$q%");
            });
        }

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type_id', $request->fuel_type);
        }

        $distributions = $query->paginate(10)->withQueryString();
        $fuelTypes = FuelType::where('status', 'aktif')->get();
        $totalVolume = Distribution::where('operator_id', auth()->id())
            ->where('status', 'selesai')->sum('volume_liter');

        return view('operator.history', compact('distributions', 'fuelTypes', 'totalVolume'));
    }

    /** Admin: tampilkan semua data distribusi */
    public function adminIndex(Request $request)
    {
        $query = Distribution::with(['operator', 'spbu', 'fuelType'])->latest('distributed_at');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($q2) use ($q) {
                $q2->where('distribution_code', 'like', "%$q%")
                    ->orWhere('vehicle_plate', 'like', "%$q%")
                    ->orWhereHas('operator', fn($r) => $r->where('name', 'like', "%$q%"));
            });
        }

        if ($request->filled('spbu')) {
            $query->where('spbu_id', $request->spbu);
        }
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type_id', $request->fuel_type);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('distributed_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('distributed_at', '<=', $request->date_to);
        }

        $distributions = $query->paginate(15)->withQueryString();
        $spbus = Spbu::where('status', 'aktif')->get();
        $fuelTypes = FuelType::where('status', 'aktif')->get();
        $stats = [
            'total' => Distribution::count(),
            'selesai' => Distribution::where('status', 'selesai')->count(),
            'total_volume' => Distribution::where('status', 'selesai')->sum('volume_liter'),
            'today' => Distribution::whereDate('distributed_at', today())->count(),
        ];

        return view('admin.distribution-data', compact('distributions', 'spbus', 'fuelTypes', 'stats'));
    }

    /** Superadmin: live monitoring */
    public function liveMonitoring()
    {
        // Auto-expire QR codes
        QrCode::where('status', 'aktif')
            ->where('valid_until', '<', today())
            ->update(['status' => 'expired']);

        $recentDistributions = Distribution::with(['operator', 'spbu', 'fuelType'])
            ->latest('distributed_at')
            ->take(20)
            ->get();

        $stats = [
            'total_today' => Distribution::whereDate('distributed_at', today())->count(),
            'total_volume' => Distribution::where('status', 'selesai')->sum('volume_liter'),
            'active_qr' => QrCode::where('status', 'aktif')->count(),
            'active_spbu' => Spbu::where('status', 'aktif')->count(),
        ];

        // Volume per BBM type (for chart)
        $volumeByFuel = Distribution::where('distributions.status', 'selesai')
            ->join('fuel_types', 'distributions.fuel_type_id', '=', 'fuel_types.id')
            ->selectRaw('fuel_types.name, SUM(distributions.volume_liter) as total')
            ->groupBy('fuel_types.name')
            ->get();

        return view('superadmin.live-monitoring', compact('recentDistributions', 'stats', 'volumeByFuel'));
    }

    /** Superadmin: audit reports */
    public function auditReports(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));

        [$year, $mon] = explode('-', $month);

        $distributions = Distribution::with(['operator', 'spbu', 'fuelType'])
            ->whereYear('distributed_at', $year)
            ->whereMonth('distributed_at', $mon)
            ->latest('distributed_at')
            ->get();

        $stats = [
            'total' => $distributions->count(),
            'total_volume' => $distributions->where('status', 'selesai')->sum('volume_liter'),
            'by_fuel' => $distributions->groupBy('fuelType.name')
                ->map(fn($g) => $g->sum('volume_liter')),
            'by_spbu' => $distributions->groupBy('spbu.name')
                ->map(fn($g) => $g->count()),
        ];

        // Daily volume for chart (for the selected month)
        $dailyVolume = Distribution::where('distributions.status', 'selesai')
            ->whereYear('distributed_at', $year)
            ->whereMonth('distributed_at', $mon)
            ->selectRaw('DATE(distributed_at) as date, SUM(volume_liter) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Pilih view sesuai role agar layout sidebar benar
        $view = auth()->user()->role === 'admin_pusat'
            ? 'superadmin.audit-reports'
            : 'admin.reports';

        return view($view, compact('distributions', 'stats', 'dailyVolume', 'month'));
    }

    /** Driver/Operator Dashboard */
    public function operatorDashboard()
    {
        $driverId = auth()->id();
        $totalShipments = Distribution::where('operator_id', $driverId)->count();
        $totalVolume = Distribution::where('operator_id', $driverId)->sum('volume_liter');

        $activeSuratJalan = SuratJalan::with(['spbu', 'fuelType'])
            ->where('driver_id', $driverId)
            ->whereIn('status', ['menunggu', 'terverifikasi', 'dikirim'])
            ->first();

        $recentDistributions = Distribution::with(['spbu', 'fuelType'])
            ->where('operator_id', $driverId)
            ->orderBy('distributed_at', 'desc')
            ->limit(5)
            ->get();

        return view('operator.dashboard', compact('totalShipments', 'totalVolume', 'activeSuratJalan', 'recentDistributions'));
    }

    /** Superadmin Dashboard */
    public function superadminDashboard()
    {
        $totalSpbu = Spbu::where('status', 'aktif')->count();
        $todayVolumeLiter = Distribution::whereDate('distributed_at', today())->where('status', 'selesai')->sum('volume_liter');
        $todayVolumeKl = $todayVolumeLiter / 1000;
        $activeQr = QrCode::where('status', 'aktif')->count();

        $recentDistributions = Distribution::with(['spbu', 'fuelType', 'qrCode'])
            ->latest('distributed_at')
            ->limit(5)
            ->get();

        return view('superadmin.dashboard', compact('totalSpbu', 'todayVolumeKl', 'activeQr', 'recentDistributions'));
    }
}

