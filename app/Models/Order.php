<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    const STATUS_PREPARING = 'preparing';
    const STATUS_ON_DELIVERY = 'on_delivery';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_READY_FOR_PICKUP = 'ready_for_pickup';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'items',
        'subtotal',
        'taxes',
        'delivery_fee',
        'negotiated_delivery_fee',
        'negotiation_status',
        'negotiation_message',
        'total',
        'status',
        'type',
        'midtrans_order_id',
    ];

    protected $casts = [
        'items' => 'array',
        'subtotal' => 'decimal:2',
        'taxes' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'negotiated_delivery_fee' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
