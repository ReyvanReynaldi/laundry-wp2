<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'order_number',
        'weight',
        'pickup_date',
        'pickup_time',
        'delivery_date',
        'delivery_time',
        'pickup_address',
        'delivery_address',
        'special_instructions',
        'status',
        'total_amount',
        'payment_status',
        'payment_method'
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'delivery_date' => 'date',
        'total_amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getStatusTextAttribute()
    {
        $statusMap = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'ready' => 'Siap',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $statusMap[$this->status] ?? 'Tidak Diketahui';
    }

    public function getStatusColorAttribute()
    {
        $colorMap = [
            'pending' => 'warning',
            'processing' => 'info',
            'ready' => 'success',
            'completed' => 'primary',
            'cancelled' => 'danger'
        ];

        return $colorMap[$this->status] ?? 'secondary';
    }

    public function getProgressPercentageAttribute()
    {
        $progressMap = [
            'pending' => 25,
            'processing' => 50,
            'ready' => 75,
            'completed' => 100,
            'cancelled' => 0
        ];

        return $progressMap[$this->status] ?? 0;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->order_number) {
                $order->order_number = 'LDR-' . date('Ymd') . '-' . str_pad(static::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
