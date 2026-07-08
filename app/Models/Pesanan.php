<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'kode_pesanan',
        'spbu_id',
        'fuel_type_id',
        'volume_liter',
        'status',
        'created_by',
    ];

    // Relationships
    public function spbu()
    {
        return $this->belongsTo(Spbu::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function suratJalan()
    {
        return $this->hasOne(SuratJalan::class, 'pesanan_id');
    }

    // Helpers
    public static function generateKode(): string
    {
        $date  = now()->format('Ymd');
        $count = static::whereDate('created_at', today())->count() + 1;
        return 'ORD-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'menunggu'   => 'Menunggu Persetujuan',
            'disetujui'  => 'Disetujui',
            'dikirim'    => 'Sedang Dikirim',
            'selesai'    => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default      => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'menunggu'   => 'amber',
            'disetujui'  => 'blue',
            'dikirim'    => 'purple',
            'selesai'    => 'green',
            'dibatalkan' => 'red',
            default      => 'slate',
        };
    }
}
