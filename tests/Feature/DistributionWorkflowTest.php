<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Spbu;
use App\Models\FuelType;
use App\Models\SuratJalan;
use App\Models\QrCode;
use App\Models\Distribution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class DistributionWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create Seed Data for Testing
        $this->pusat = User::create([
            'name' => 'Pusat User',
            'email' => 'pusat@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin_pusat',
            'is_active' => true,
        ]);

        $this->depo = User::create([
            'name' => 'Depo User',
            'email' => 'depo@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin_depo',
            'is_active' => true,
        ]);

        $this->driver = User::create([
            'name' => 'Driver User',
            'email' => 'driver@test.com',
            'password' => bcrypt('password'),
            'role' => 'driver',
            'is_active' => true,
        ]);

        $this->spbu = Spbu::create([
            'name' => 'SPBU Pasteur Test',
            'code' => '34.111.11',
            'city' => 'Bandung',
            'address' => 'Jl. Pasteur',
            'status' => 'aktif',
        ]);

        $this->fuelType = FuelType::create([
            'name' => 'Pertalite',
            'code' => 'PRTL',
            'status' => 'aktif',
        ]);
    }

    public function test_full_fuel_distribution_workflow()
    {
        // 1. Admin Pusat creates Surat Jalan
        $this->actingAs($this->pusat);

        $response = $this->post(route('superadmin.surat-jalan.store'), [
            'tanggal_kirim' => now()->toDateString(),
            'spbu_id' => $this->spbu->id,
            'fuel_type_id' => $this->fuelType->id,
            'volume_liter' => 8000,
            'driver_id' => $this->driver->id,
            'vehicle_plate' => 'D 1234 ABC',
            'notes' => 'Test Penugasan',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('surat_jalan', [
            'driver_id' => $this->driver->id,
            'spbu_id' => $this->spbu->id,
            'status' => 'menunggu',
        ]);

        $sj = SuratJalan::first();

        // 2. Admin Depo verifies Surat Jalan
        $this->actingAs($this->depo);
        $response = $this->patch(route('admin.surat-jalan.verify', $sj->id), [
            'vehicle_plate' => 'D 1234 ABC',
        ]);
        $response->assertRedirect();
        $this->assertEquals('terverifikasi', $sj->fresh()->status);

        // 3. Admin Depo marks as "dikirim" (Lepas Kirim)
        $response = $this->patch(route('admin.surat-jalan.dikirim', $sj->id));
        $response->assertRedirect();
        $this->assertEquals('dikirim', $sj->fresh()->status);

        // 4. Admin Depo creates a QR Code for the SPBU Pasteur and Pertalite
        $qrToken = Str::uuid()->toString();
        $qrCode = QrCode::create([
            'qr_id' => 'QR-TEST-001',
            'token' => $qrToken,
            'spbu_id' => $this->spbu->id,
            'fuel_type_id' => $this->fuelType->id,
            'kuota_liter' => 8000,
            'status' => 'aktif',
            'valid_from' => now()->toDateString(),
            'valid_until' => now()->addDay()->toDateString(),
            'created_by' => $this->depo->id,
        ]);

        // 5. Driver completes the Surat Jalan using the QR Token UUID
        $this->actingAs($this->driver);
        $response = $this->post(route('operator.surat-jalan.complete', $sj->id), [
            'token' => $qrToken,
        ]);

        $response->assertJson(['success' => true]);

        // Assert QR Code status is updated
        $this->assertEquals('digunakan', $qrCode->fresh()->status);

        // Assert Surat Jalan status is updated to selesai
        $this->assertEquals('selesai', $sj->fresh()->status);

        // Assert Distribution entry is created
        $this->assertDatabaseHas('distributions', [
            'surat_jalan_id' => $sj->id,
            'qr_code_id' => $qrCode->id,
            'operator_id' => $this->driver->id,
            'spbu_id' => $this->spbu->id,
            'fuel_type_id' => $this->fuelType->id,
            'volume_liter' => 8000,
            'status' => 'selesai',
        ]);
    }

    public function test_spbu_admin_verifies_barcode()
    {
        // Setup SPBU Admin
        $spbuAdmin = User::create([
            'name' => 'SPBU Admin User',
            'email' => 'spbu_admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin_spbu',
            'spbu_id' => $this->spbu->id,
            'is_active' => true,
        ]);

        // Create a Surat Jalan with status 'dikirim'
        $sj = SuratJalan::create([
            'kode_surat_jalan' => 'SJ-TEST-BARCODE-001',
            'driver_id' => $this->driver->id,
            'spbu_id' => $this->spbu->id,
            'fuel_type_id' => $this->fuelType->id,
            'volume_liter' => 8000,
            'vehicle_plate' => 'D 1234 ABC',
            'tanggal_kirim' => now()->toDateString(),
            'status' => 'dikirim',
            'created_by' => $this->pusat->id,
        ]);

        // Act as SPBU Admin
        $this->actingAs($spbuAdmin);

        // Submit barcode verification request
        $response = $this->post(route('spbu.verify.submit'), [
            'barcode' => 'SJ-TEST-BARCODE-001',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Assert Surat Jalan status is updated to selesai
        $this->assertEquals('selesai', $sj->fresh()->status);

        // Assert Distribution entry is created
        $this->assertDatabaseHas('distributions', [
            'surat_jalan_id' => $sj->id,
            'operator_id' => $this->driver->id,
            'spbu_id' => $this->spbu->id,
            'fuel_type_id' => $this->fuelType->id,
            'volume_liter' => 8000,
        ]);
    }

    public function test_delete_spbu_with_active_relations_fails_gracefully()
    {
        // 1. Create a Surat Jalan referencing the SPBU
        $sj = SuratJalan::create([
            'kode_surat_jalan' => 'SJ-TEST-DELETE-001',
            'driver_id' => $this->driver->id,
            'spbu_id' => $this->spbu->id,
            'fuel_type_id' => $this->fuelType->id,
            'volume_liter' => 8000,
            'vehicle_plate' => 'D 1234 ABC',
            'tanggal_kirim' => now()->toDateString(),
            'status' => 'menunggu',
            'created_by' => $this->pusat->id,
        ]);

        // 2. Act as Admin Pusat (superadmin)
        $this->actingAs($this->pusat);

        // 3. Try to delete the SPBU Pasteur
        $response = $this->delete(route('superadmin.master-data.spbu.destroy', $this->spbu->id));

        // 4. Assert response redirects back with error session key
        $response->assertRedirect();
        $response->assertSessionHas('error');

        // Assert SPBU still exists in database
        $this->assertDatabaseHas('spbus', ['id' => $this->spbu->id]);
    }
}
