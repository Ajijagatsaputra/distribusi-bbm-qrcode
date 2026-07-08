<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'spbu_id',
    ];

    public function isAdminPusat(): bool
    {
        return $this->role === 'admin_pusat';
    }
    public function isAdminDepo(): bool
    {
        return $this->role === 'admin_depo';
    }
    public function isDriver(): bool
    {
        return $this->role === 'driver';
    }
    public function isAdminSpbu(): bool
    {
        return $this->role === 'admin_spbu';
    }

    public function spbu()
    {
        return $this->belongsTo(Spbu::class, 'spbu_id');
    }

    public function distributions()
    {
        return $this->hasMany(\App\Models\Distribution::class, 'operator_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
