<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('capacity');         // "8.000 Liter (8 KL)"
            $table->integer('capacity_liter');  // 8000 (angka murni untuk kalkulasi)
            $table->string('compartments');     // "1 - 2 Sekat"
            $table->string('vehicle_type');     // "Rigid Truck (6 Roda)"
            $table->text('description')->nullable(); // Peruntukan utama
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};
