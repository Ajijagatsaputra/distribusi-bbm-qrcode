<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->string('distribution_code')->unique(); // "DIST-20260625-001"
            $table->foreignId('qr_code_id')->nullable()->constrained('qr_codes')->onDelete('set null');
            $table->foreignId('operator_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('spbu_id')->constrained('spbus')->onDelete('restrict');
            $table->foreignId('fuel_type_id')->constrained('fuel_types')->onDelete('restrict');
            $table->string('vehicle_plate');   // Nomor polisi kendaraan
            $table->string('driver_name');     // Nama pengemudi
            $table->integer('volume_liter');   // Volume actual yang didistribusikan
            $table->enum('status', ['pending', 'selesai', 'gagal'])->default('selesai');
            $table->text('notes')->nullable();
            $table->timestamp('distributed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
