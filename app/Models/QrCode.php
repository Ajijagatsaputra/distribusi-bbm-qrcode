<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_id',
        'token',
        'spbu_id',
        'fuel_type_id',
        'kuota_liter',
        'status',
        'valid_from',
        'valid_until',
        'created_by',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

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

    public function distribution()
    {
        return $this->hasOne(Distribution::class);
    }

    /** Auto-expire QR if past valid_until */
    public function checkAndExpire(): void
    {
        if ($this->status === 'aktif' && $this->valid_until->isPast()) {
            $this->update(['status' => 'expired']);
        }
    }
}
