<?php

namespace App\Events;

use App\Models\Distribution;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DistributionCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $payload;

    public function __construct(Distribution $distribution)
    {
        // Eager load relasi agar bisa diakses
        $distribution->loadMissing(['spbu', 'fuelType', 'operator']);

        $this->payload = [
            'distribution_code' => $distribution->distribution_code,
            'spbu_name' => $distribution->spbu->name ?? '-',
            'fuel_name' => $distribution->fuelType->name ?? '-',
            'volume_liter' => $distribution->volume_liter,
            'driver_name' => $distribution->driver_name,
            'vehicle_plate' => $distribution->vehicle_plate,
            'status' => $distribution->status,
            'distributed_at' => $distribution->distributed_at?->diffForHumans() ?? 'Baru saja',
            'spbu_id' => $distribution->spbu_id,
            // Stats terbaru (langsung hitung di sini untuk efisiensi)
            'stats' => [
                'total_today' => Distribution::whereDate('distributed_at', today())->count(),
                'total_volume' => Distribution::where('status', 'selesai')->sum('volume_liter'),
                'active_qr' => \App\Models\QrCode::where('status', 'aktif')->count(),
                'active_spbu' => \App\Models\Spbu::where('status', 'aktif')->count(),
            ],
        ];
    }

    /**
     * Broadcast pada channel publik "distributions"
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('distributions'),
        ];
    }

    /**
     * Nama event yang didengarkan di frontend
     */
    public function broadcastAs(): string
    {
        return 'distribution.created';
    }
}
