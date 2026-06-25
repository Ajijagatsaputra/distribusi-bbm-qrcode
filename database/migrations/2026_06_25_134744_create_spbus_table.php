<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spbus', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // "SPBU 34.123.01"
            $table->string('code')->unique(); // "34.123.01"
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spbus');
    }
};
