<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Modify users role and add spbu_id
        // Using raw SQL for MySQL enum to avoid doctrine/dbal issues with enum change
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin_pusat', 'admin_depo', 'driver', 'admin_spbu') DEFAULT 'driver'");

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('spbu_id')->nullable()->after('password')->constrained('spbus')->onDelete('set null');
        });

        // 2. Create pesanans table
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->unique();
            $table->foreignId('spbu_id')->constrained('spbus')->onDelete('restrict');
            $table->foreignId('fuel_type_id')->constrained('fuel_types')->onDelete('restrict');
            $table->integer('volume_liter');
            $table->enum('status', ['menunggu', 'disetujui', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });

        // 3. Update surat_jalan table (driver_id and vehicle_plate nullable, add pesanan_id)
        Schema::table('surat_jalan', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
        });

        Schema::table('surat_jalan', function (Blueprint $table) {
            $table->unsignedBigInteger('driver_id')->nullable()->change();
            $table->string('vehicle_plate')->nullable()->change();
            $table->foreignId('pesanan_id')->nullable()->after('id')->constrained('pesanans')->onDelete('set null');
        });

        Schema::table('surat_jalan', function (Blueprint $table) {
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_jalan', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->dropColumn('pesanan_id');
        });

        // Revert columns to not-nullable
        Schema::table('surat_jalan', function (Blueprint $table) {
            $table->dropForeign(['driver_id']);
        });

        // Fill null values first if any
        DB::table('surat_jalan')->whereNull('driver_id')->update(['driver_id' => 1]); // fallback
        DB::table('surat_jalan')->whereNull('vehicle_plate')->update(['vehicle_plate' => 'B 1234 AB']); // fallback

        Schema::table('surat_jalan', function (Blueprint $table) {
            $table->unsignedBigInteger('driver_id')->nullable(false)->change();
            $table->string('vehicle_plate')->nullable(false)->change();
        });

        Schema::table('surat_jalan', function (Blueprint $table) {
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::dropIfExists('pesanans');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['spbu_id']);
            $table->dropColumn('spbu_id');
        });

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin_pusat', 'admin_depo', 'driver') DEFAULT 'driver'");
    }
};
