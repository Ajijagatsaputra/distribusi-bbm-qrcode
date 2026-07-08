<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $table = 'surat_jalan';

    protected $fillable = [
        'kode_surat_jalan',
        'driver_id',
        'spbu_id',
        'fuel_type_id',
        'volume_liter',
        'vehicle_plate',
        'tanggal_kirim',
        'catatan',
        'status',
        'created_by',
        'verified_by',
        'verified_at',
        'completed_at',
        'pesanan_id',
    ];

    protected $casts = [
        'tanggal_kirim' => 'date',
        'verified_at'   => 'datetime',
        'completed_at'  => 'datetime',
    ];

    // ── Relationships ──────────────────────────────────────────────────
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function spbu()
    {
        return $this->belongsTo(Spbu::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function distribution()
    {
        return $this->hasOne(Distribution::class);
    }

    // ── Helpers ────────────────────────────────────────────────────────
    public static function generateKode(): string
    {
        $date  = now()->format('Ymd');
        $count = static::whereDate('created_at', today())->count() + 1;
        return 'SJ-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'menunggu'      => 'Menunggu Verifikasi',
            'terverifikasi' => 'Terverifikasi',
            'dikirim'       => 'Sedang Dikirim',
            'selesai'       => 'Selesai',
            'dibatalkan'    => 'Dibatalkan',
            default         => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'menunggu'      => 'amber',
            'terverifikasi' => 'blue',
            'dikirim'       => 'purple',
            'selesai'       => 'green',
            'dibatalkan'    => 'red',
            default         => 'slate',
        };
    }
}
