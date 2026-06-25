<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_jalan_id',
        'distribution_code',
        'qr_code_id',
        'operator_id',
        'spbu_id',
        'fuel_type_id',
        'vehicle_plate',
        'driver_name',
        'volume_liter',
        'status',
        'notes',
        'distributed_at',
    ];

    protected $casts = [
        'distributed_at' => 'datetime',
    ];

    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class);
    }

    public function qrCode()
    {
        return $this->belongsTo(QrCode::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function spbu()
    {
        return $this->belongsTo(Spbu::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class);
    }

    /** Generate a unique distribution code */
    public static function generateCode(): string
    {
        $date = now()->format('Ymd');
        $count = static::whereDate('created_at', today())->count() + 1;
        return 'DIST-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
