<?php

namespace App\Http\Controllers;

use App\Models\FuelType;
use App\Models\VehicleType;
use App\Models\Distribution;
use App\Models\Spbu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MasterDataController extends Controller
{
    public function index()
    {
        $fuelTypes = FuelType::orderBy('name')->get();
        $vehicleTypes = VehicleType::orderBy('capacity_liter')->get();
        $spbus = Spbu::orderBy('name')->get();
        $stats = [
            'total_distributions' => Distribution::where('status', 'selesai')->count(),
            'total_spbu' => Spbu::where('status', 'aktif')->count(),
            'total_fuel_types' => FuelType::where('status', 'aktif')->count(),
            'total_vehicle_types' => VehicleType::count(),
        ];
        return view('superadmin.master-data', compact('fuelTypes', 'vehicleTypes', 'spbus', 'stats'));
    }

    // ===== FUEL TYPES =====
    public function storeFuel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10|unique:fuel_types,code',
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);
        FuelType::create($validated);
        return back()->with('success', 'Jenis BBM berhasil ditambahkan.');
    }

    public function updateFuel(Request $request, FuelType $fuelType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'code' => ['required', 'string', 'max:10', Rule::unique('fuel_types')->ignore($fuelType->id)],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);
        $fuelType->update($validated);
        return back()->with('success', 'Data BBM berhasil diperbarui.');
    }

    public function destroyFuel(FuelType $fuelType)
    {
        try {
            $fuelType->delete();
            return back()->with('success', 'Jenis BBM berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return back()->with('error', 'Jenis BBM ini tidak dapat dihapus karena masih terhubung dengan data lain (seperti pesanan, surat jalan, atau QR code).');
            }
            throw $e;
        }
    }

    // ===== VEHICLE TYPES =====
    public function storeVehicle(Request $request)
    {
        $validated = $request->validate([
            'capacity' => 'required|string|max:100',
            'capacity_liter' => 'required|integer|min:1',
            'compartments' => 'required|string|max:50',
            'vehicle_type' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);
        VehicleType::create($validated);
        return back()->with('success', 'Klasifikasi armada berhasil ditambahkan.');
    }

    public function updateVehicle(Request $request, VehicleType $vehicleType)
    {
        $validated = $request->validate([
            'capacity' => 'required|string|max:100',
            'capacity_liter' => 'required|integer|min:1',
            'compartments' => 'required|string|max:50',
            'vehicle_type' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);
        $vehicleType->update($validated);
        return back()->with('success', 'Data armada berhasil diperbarui.');
    }

    public function destroyVehicle(VehicleType $vehicleType)
    {
        try {
            $vehicleType->delete();
            return back()->with('success', 'Klasifikasi armada berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return back()->with('error', 'Klasifikasi armada ini tidak dapat dihapus karena masih terhubung dengan data lain.');
            }
            throw $e;
        }
    }

    // ===== SPBU =====
    public function storeSpbu(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'code' => 'required|string|max:30|unique:spbus,code',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);
        Spbu::create($validated);
        return back()->with('success', 'SPBU berhasil ditambahkan.');
    }

    public function updateSpbu(Request $request, Spbu $spbu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'code' => ['required', 'string', 'max:30', Rule::unique('spbus')->ignore($spbu->id)],
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);
        $spbu->update($validated);
        return back()->with('success', 'Data SPBU berhasil diperbarui.');
    }

    public function destroySpbu(Spbu $spbu)
    {
        try {
            $spbu->delete();
            return back()->with('success', 'SPBU berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') {
                return back()->with('error', 'SPBU ini tidak dapat dihapus karena masih terhubung dengan data lain (seperti pesanan, surat jalan, QR code, atau akun user).');
            }
            throw $e;
        }
    }
}
