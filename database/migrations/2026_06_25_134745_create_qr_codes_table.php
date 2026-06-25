<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('qr_id')->unique();           // "QR-PLT-20260207-001"
            $table->string('token')->unique();            // token unik untuk QR image
            $table->foreignId('spbu_id')->constrained('spbus')->onDelete('restrict');
            $table->foreignId('fuel_type_id')->constrained('fuel_types')->onDelete('restrict');
            $table->integer('kuota_liter');               // 8000
            $table->enum('status', ['aktif', 'digunakan', 'expired'])->default('aktif');
            $table->date('valid_from');
            $table->date('valid_until');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
