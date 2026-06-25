<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use App\Models\Spbu;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class QrCodeController extends Controller
{
    public function index()
    {
        // Auto-expire QR codes past their valid_until date
        QrCode::where('status', 'aktif')
            ->where('valid_until', '<', today())
            ->update(['status' => 'expired']);

        $qrCodes = QrCode::with(['spbu', 'fuelType', 'creator'])
            ->latest()
            ->paginate(15);

        $stats = [
            'total' => QrCode::count(),
            'aktif' => QrCode::where('status', 'aktif')->count(),
            'digunakan' => QrCode::where('status', 'digunakan')->count(),
            'expired' => QrCode::where('status', 'expired')->count(),
        ];

        $spbus = Spbu::where('status', 'aktif')->orderBy('name')->get();
        $fuelTypes = FuelType::where('status', 'aktif')->orderBy('name')->get();

        $view = auth()->user()->role === 'admin_depo' ? 'admin.qr-management' : 'superadmin.qr-code-management';
        return view($view, compact('qrCodes', 'stats', 'spbus', 'fuelTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'spbu_id' => 'required|exists:spbus,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'kuota_liter' => 'required|integer|min:100',
            'durasi' => 'required|integer|min:1|max:30',
        ]);

        $spbu = Spbu::find($validated['spbu_id']);
        $fuel = FuelType::find($validated['fuel_type_id']);
        $date = now()->format('Ymd');
        $count = QrCode::whereDate('created_at', today())->count() + 1;

        $qrId = 'QR-' . $fuel->code . '-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        $token = Str::uuid()->toString();

        QrCode::create([
            'qr_id' => $qrId,
            'token' => $token,
            'spbu_id' => $validated['spbu_id'],
            'fuel_type_id' => $validated['fuel_type_id'],
            'kuota_liter' => $validated['kuota_liter'],
            'status' => 'aktif',
            'valid_from' => today(),
            'valid_until' => today()->addDays((int) $validated['durasi']),
            'created_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'qr_id' => $qrId,
            'token' => $token,
        ]);
    }

    public function update(Request $request, QrCode $qrCode)
    {
        $validated = $request->validate([
            'kuota_liter' => 'required|integer|min:100',
            'status' => 'required|in:aktif,digunakan,expired',
        ]);

        $qrCode->update($validated);

        $route = auth()->user()->role === 'admin_depo' ? 'admin.qr-management' : 'superadmin.qr-code-management';
        return redirect()->route($route)
            ->with('success', 'Data QR Code berhasil diperbarui.');
    }

    public function destroy(QrCode $qrCode)
    {
        if ($qrCode->distribution()->exists()) {
            $route = auth()->user()->role === 'admin_depo' ? 'admin.qr-management' : 'superadmin.qr-code-management';
            return redirect()->route($route)
                ->with('error', 'QR Code ini sudah digunakan dalam transaksi distribusi.');
        }
        $qrCode->delete();
        $route = auth()->user()->role === 'admin_depo' ? 'admin.qr-management' : 'superadmin.qr-code-management';
        return redirect()->route($route)
            ->with('success', 'QR Code berhasil dihapus.');
    }

    /** Validate QR from scan — returns JSON for operator scanning */
    public function validateQr(Request $request)
    {
        $qrCode = QrCode::with(['spbu', 'fuelType'])
            ->where('token', $request->token)
            ->first();

        if (!$qrCode) {
            return response()->json(['valid' => false, 'message' => 'QR Code tidak ditemukan.'], 404);
        }

        if ($qrCode->status !== 'aktif') {
            return response()->json(['valid' => false, 'message' => 'QR Code sudah ' . $qrCode->status . '.'], 422);
        }

        if ($qrCode->valid_until->isPast()) {
            $qrCode->update(['status' => 'expired']);
            return response()->json(['valid' => false, 'message' => 'QR Code sudah expired.'], 422);
        }

        return response()->json([
            'valid' => true,
            'qr_id' => $qrCode->qr_id,
            'qr_code_id' => $qrCode->id,
            'spbu' => $qrCode->spbu->name,
            'spbu_id' => $qrCode->spbu_id,
            'fuel_type' => $qrCode->fuelType->name,
            'fuel_type_id' => $qrCode->fuel_type_id,
            'kuota_liter' => $qrCode->kuota_liter,
            'valid_until' => $qrCode->valid_until->format('d M Y'),
        ]);
    }
}
