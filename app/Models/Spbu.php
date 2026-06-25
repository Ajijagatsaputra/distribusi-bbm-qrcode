<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spbu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'address', 'city', 'status'];

    public function qrCodes()
    {
        return $this->hasMany(QrCode::class);
    }

    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }

    public function isAktif(): bool
    {
        return $this->status === 'aktif';
    }
}
