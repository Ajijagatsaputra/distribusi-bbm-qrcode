<?php

namespace Database\Seeders;

use App\Models\FuelType;
use App\Models\VehicleType;
use App\Models\Spbu;
use App\Models\User;
use App\Models\QrCode;
use App\Models\Distribution;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // ── 1. USERS ─────────────────────────────────────────────────────────
        $superadmin = User::updateOrCreate(['email' => 'adminpusat@bbm.com'], [
            'name' => 'Budi Santoso',
            'password' => Hash::make('password'),
            'role' => 'admin_pusat',
            'is_active' => true,
        ]);

        $admin = User::updateOrCreate(['email' => 'admindepo@bbm.com'], [
            'name' => 'Siti Rahayu',
            'password' => Hash::make('password'),
            'role' => 'admin_depo',
            'is_active' => true,
        ]);

        $operators = [];
        $operatorData = [
            ['name' => 'Ahmad Fauzi', 'email' => 'driver1@bbm.com'],
            ['name' => 'Dedi Kurniawan', 'email' => 'driver2@bbm.com'],
            ['name' => 'Rina Marlina', 'email' => 'driver3@bbm.com'],
        ];
        foreach ($operatorData as $op) {
            $operators[] = User::updateOrCreate(['email' => $op['email']], [
                'name' => $op['name'],
                'password' => Hash::make('password'),
                'role' => 'driver',
                'is_active' => true,
            ]);
        }

        // ── 2. FUEL TYPES ────────────────────────────────────────────────────
        $fuels = [
            ['name' => 'Pertalite', 'code' => 'PRTL', 'status' => 'aktif'],
            ['name' => 'Pertamax', 'code' => 'PRTX', 'status' => 'aktif'],
            ['name' => 'Pertamax Turbo', 'code' => 'PRTB', 'status' => 'aktif'],
            ['name' => 'Bio Solar', 'code' => 'BSLR', 'status' => 'aktif'],
            ['name' => 'Dexlite', 'code' => 'DXLT', 'status' => 'aktif'],
        ];
        foreach ($fuels as $fuel) {
            FuelType::updateOrCreate(['code' => $fuel['code']], $fuel);
        }
        $fuelTypes = FuelType::all();

        // ── 3. VEHICLE TYPES ─────────────────────────────────────────────────
        VehicleType::truncate();
        $vehicles = [
            ['capacity' => '5.000 Liter (5 KL)', 'capacity_liter' => 5000, 'compartments' => '1 - 2 Sekat', 'vehicle_type' => 'Rigid Truck (4 Roda)', 'description' => 'Pertashop, SPBU di gang sempit, atau daerah terpencil.'],
            ['capacity' => '8.000 Liter (8 KL)', 'capacity_liter' => 8000, 'compartments' => '1 - 2 Sekat', 'vehicle_type' => 'Rigid Truck (6 Roda)', 'description' => 'SPBU menengah, wilayah perkotaan dengan akses standar.'],
            ['capacity' => '16.000 Liter (16 KL)', 'capacity_liter' => 16000, 'compartments' => '2 - 3 Sekat', 'vehicle_type' => 'Rigid Truck (10 Roda)', 'description' => 'SPBU besar dengan volume penjualan tinggi.'],
            ['capacity' => '24.000 Liter (24 KL)', 'capacity_liter' => 24000, 'compartments' => '3 - 4 Sekat', 'vehicle_type' => 'Trailer / Tractor Head', 'description' => 'Distribusi antar depo atau SPBU besar di jalur lintas provinsi.'],
            ['capacity' => '32.000 Liter (32 KL)', 'capacity_liter' => 32000, 'compartments' => '4 Sekat', 'vehicle_type' => 'Trailer / Tractor Head', 'description' => 'Distribusi jarak jauh (Long Haul) antar terminal BBM.'],
            ['capacity' => '40.000 Liter (40 KL)', 'capacity_liter' => 40000, 'compartments' => '4 - 5 Sekat', 'vehicle_type' => 'Trailer (Giga/Scania)', 'description' => 'Distribusi skala besar dari Terminal BBM ke wilayah industri atau depo.'],
        ];
        foreach ($vehicles as $v) {
            VehicleType::create($v);
        }

        // ── 4. SPBU ──────────────────────────────────────────────────────────
        $spbuData = [
            ['name' => 'SPBU 34.123.01 - Pasteur', 'code' => '34.123.01', 'city' => 'Bandung', 'address' => 'Jl. Dr. Djundjunan No. 120', 'latitude' => -6.896582, 'longitude' => 107.579471],
            ['name' => 'SPBU 34.121.05 - Dago', 'code' => '34.121.05', 'city' => 'Bandung', 'address' => 'Jl. Ir. H. Juanda No. 252', 'latitude' => -6.883584, 'longitude' => 107.616335],
            ['name' => 'SPBU 34.411.01 - Cimahi', 'code' => '34.411.01', 'city' => 'Cimahi', 'address' => 'Jl. Jend. H. Amir Machmud No. 55', 'latitude' => -6.882190, 'longitude' => 107.540120],
            ['name' => 'SPBU 34.152.03 - Soreang', 'code' => '34.152.03', 'city' => 'Kab. Bandung', 'address' => 'Jl. Raya Soreang No. 10', 'latitude' => -7.030612, 'longitude' => 107.525547],
            ['name' => 'Terminal BBM Ujung Berung', 'code' => 'TBB-UB-01', 'city' => 'Bandung', 'address' => 'Jl. AH. Nasution No. 5, Ujung Berung', 'latitude' => -6.917415, 'longitude' => 107.697412],
        ];
        foreach ($spbuData as $s) {
            Spbu::updateOrCreate(['code' => $s['code']], array_merge($s, ['status' => 'aktif']));
        }
        $spbus = Spbu::all();

        $spbuPasteur = $spbus->where('code', '34.123.01')->first();
        if ($spbuPasteur) {
            User::updateOrCreate(['email' => 'adminspbu1@bbm.com'], [
                'name' => 'Admin SPBU Pasteur',
                'password' => Hash::make('password'),
                'role' => 'admin_spbu',
                'is_active' => true,
                'spbu_id' => $spbuPasteur->id,
            ]);
        }

        $spbuDago = $spbus->where('code', '34.121.05')->first();
        if ($spbuDago) {
            User::updateOrCreate(['email' => 'adminspbu2@bbm.com'], [
                'name' => 'Admin SPBU Dago',
                'password' => Hash::make('password'),
                'role' => 'admin_spbu',
                'is_active' => true,
                'spbu_id' => $spbuDago->id,
            ]);
        }

        // ── 5. QR CODES ──────────────────────────────────────────────────────
        Distribution::truncate();
        QrCode::truncate();
        $qrSeeds = [
            ['spbu' => '34.123.01', 'fuel' => 'PRTL', 'kuota' => 8000, 'days_ago' => 0, 'valid_for' => 1, 'status' => 'aktif'],
            ['spbu' => '34.123.01', 'fuel' => 'PRTX', 'kuota' => 8000, 'days_ago' => 0, 'valid_for' => 1, 'status' => 'digunakan'],
            ['spbu' => '34.121.05', 'fuel' => 'BSLR', 'kuota' => 6000, 'days_ago' => 3, 'valid_for' => 1, 'status' => 'expired'],
            ['spbu' => '34.411.01', 'fuel' => 'PRTL', 'kuota' => 16000, 'days_ago' => 1, 'valid_for' => 2, 'status' => 'aktif'],
            ['spbu' => '34.152.03', 'fuel' => 'DXLT', 'kuota' => 5000, 'days_ago' => 0, 'valid_for' => 1, 'status' => 'aktif'],
            ['spbu' => 'TBB-UB-01', 'fuel' => 'PRTB', 'kuota' => 32000, 'days_ago' => 2, 'valid_for' => 2, 'status' => 'digunakan'],
        ];

        foreach ($qrSeeds as $i => $seed) {
            $spbu = $spbus->where('code', $seed['spbu'])->first();
            $fuel = $fuelTypes->where('code', $seed['fuel'])->first();
            $createdAt = Carbon::now()->subDays($seed['days_ago']);
            $validFrom = $createdAt->toDateString();
            $validUntil = $createdAt->addDays($seed['valid_for'])->toDateString();
            $qrId = 'QR-' . $fuel->code . '-' . $createdAt->format('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);

            QrCode::create([
                'qr_id' => $qrId,
                'token' => Str::uuid()->toString(),
                'spbu_id' => $spbu->id,
                'fuel_type_id' => $fuel->id,
                'kuota_liter' => $seed['kuota'],
                'status' => $seed['status'],
                'valid_from' => $validFrom,
                'valid_until' => $validUntil,
                'created_by' => $superadmin->id,
            ]);
        }

        // ── 6. DISTRIBUTIONS ─────────────────────────────────────────────────
        $distSeeds = [
            ['op' => 0, 'spbu' => '34.123.01', 'fuel' => 'PRTL', 'plate' => 'B 1234 AB', 'driver' => 'Ahmad Fauzi', 'vol' => 8000, 'daysAgo' => 0],
            ['op' => 1, 'spbu' => '34.121.05', 'fuel' => 'BSLR', 'plate' => 'D 5678 CD', 'driver' => 'Dedi Kurniawan', 'vol' => 6000, 'daysAgo' => 0],
            ['op' => 0, 'spbu' => '34.411.01', 'fuel' => 'PRTL', 'plate' => 'B 9012 EF', 'driver' => 'Ahmad Fauzi', 'vol' => 16000, 'daysAgo' => 1],
            ['op' => 2, 'spbu' => '34.152.03', 'fuel' => 'DXLT', 'plate' => 'Z 3456 GH', 'driver' => 'Rina Marlina', 'vol' => 5000, 'daysAgo' => 1],
            ['op' => 1, 'spbu' => 'TBB-UB-01', 'fuel' => 'PRTX', 'plate' => 'D 7890 IJ', 'driver' => 'Dedi Kurniawan', 'vol' => 8000, 'daysAgo' => 2],
            ['op' => 0, 'spbu' => '34.123.01', 'fuel' => 'PRTB', 'plate' => 'B 2345 KL', 'driver' => 'Ahmad Fauzi', 'vol' => 32000, 'daysAgo' => 3],
            ['op' => 2, 'spbu' => '34.121.05', 'fuel' => 'PRTL', 'plate' => 'Z 6789 MN', 'driver' => 'Rina Marlina', 'vol' => 8000, 'daysAgo' => 4],
            ['op' => 1, 'spbu' => '34.411.01', 'fuel' => 'BSLR', 'plate' => 'D 0123 OP', 'driver' => 'Dedi Kurniawan', 'vol' => 16000, 'daysAgo' => 5],
        ];

        foreach ($distSeeds as $i => $d) {
            $operator = $operators[$d['op']];
            $spbu = $spbus->where('code', $d['spbu'])->first();
            $fuel = $fuelTypes->where('code', $d['fuel'])->first();
            $distAt = Carbon::now()->subDays($d['daysAgo'])->setTime(rand(7, 17), rand(0, 59));
            $date = $distAt->format('Ymd');

            Distribution::create([
                'distribution_code' => 'DIST-' . $date . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'qr_code_id' => null,
                'operator_id' => $operator->id,
                'spbu_id' => $spbu->id,
                'fuel_type_id' => $fuel->id,
                'vehicle_plate' => $d['plate'],
                'driver_name' => $d['driver'],
                'volume_liter' => $d['vol'],
                'status' => 'selesai',
                'distributed_at' => $distAt,
            ]);
        }

        $this->command->info('✅ Seeder selesai! Semua data berhasil dibuat.');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin Pusat', 'adminpusat@bbm.com', 'password'],
                ['Admin Depo', 'admindepo@bbm.com', 'password'],
                ['Admin SPBU 1 (Pasteur)', 'adminspbu1@bbm.com', 'password'],
                ['Admin SPBU 2 (Dago)', 'adminspbu2@bbm.com', 'password'],
                ['Driver 1', 'driver1@bbm.com', 'password'],
                ['Driver 2', 'driver2@bbm.com', 'password'],
                ['Driver 3', 'driver3@bbm.com', 'password'],
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
