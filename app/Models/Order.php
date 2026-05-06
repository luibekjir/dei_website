<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'items',
        'subtotal',
        'taxes',
        'delivery_fee',
        'negotiated_delivery_fee',
        'negotiation_status',
        'negotiation_message',
        'total',
        'status',
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
}
