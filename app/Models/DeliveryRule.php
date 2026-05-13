<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryRule extends Model
{
    protected $fillable = [
        'restaurant_id',
        'type',
        'min_items',
        'min_purchase',
        'discount_percentage',
        'fixed_fee',
        'is_active',
    ];

    protected $casts = [
        'min_purchase' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'fixed_fee' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Calculate delivery fee based on order parameters.
     */
    public function calculateFee($itemsCount, $purchaseAmount, $baseFee)
    {
        if (!$this->is_active) return $baseFee;

        switch ($this->type) {
            case 'free_items':
                if ($itemsCount >= $this->min_items) return 0;
                break;
            case 'discount_items':
                if ($itemsCount >= $this->min_items) return $baseFee * (1 - ($this->discount_percentage / 100));
                break;
            case 'free_purchase':
                if ($purchaseAmount >= $this->min_purchase) return 0;
                break;
            case 'fixed':
                return $this->fixed_fee;
        }

        return $baseFee;
    }
}
