<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('surat_jalan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_surat_jalan')->unique();        // "SJ-20260626-001"
            $table->foreignId('driver_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('spbu_id')->constrained('spbus')->onDelete('restrict');
            $table->foreignId('fuel_type_id')->constrained('fuel_types')->onDelete('restrict');
            $table->integer('volume_liter');                     // Volume yang harus dikirim
            $table->string('vehicle_plate');                     // Nomor polisi kendaraan
            $table->date('tanggal_kirim');                       // Tanggal pengiriman dijadwalkan
            $table->text('catatan')->nullable();                 // Catatan tambahan dari Admin Pusat
            $table->enum('status', [
                'menunggu',     // Dibuat, belum diverifikasi Admin Depo
                'terverifikasi',// Admin Depo sudah cek driver
                'dikirim',      // Driver sedang dalam perjalanan ke SPBU
                'selesai',      // Driver scan QR di SPBU, distribusi confirmed
                'dibatalkan',   // Dibatalkan
            ])->default('menunggu');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict'); // Admin Pusat
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Admin Depo
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_jalan');
    }
};
