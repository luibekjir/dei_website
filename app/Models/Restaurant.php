<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'address',
        'rating',
        'latitude',
        'longitude',
        'facilities',
        'has_delivery',
        'supports_pickup',
        'delivery_status',
        'province_id',
        'city_id',
        'district_id',
        'user_id',
        'balance',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
    ];

    protected $casts = [
        'facilities' => 'array',
        'has_delivery' => 'boolean',
        'supports_pickup' => 'boolean',
        'delivery_status' => 'string',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function deliveryRules()
    {
        return $this->hasMany(DeliveryRule::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function getBudgetRangeAttribute()
    {
        $avgPrice = $this->menuItems()->avg('price');

        if (!$avgPrice) {
            return 'N/A';
        }

        if ($avgPrice <= 10) {
            return '$';
        } elseif ($avgPrice <= 25) {
            return '$$';
        } elseif ($avgPrice <= 50) {
            return '$$$';
        }

        return '$$$$';
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
    /**
     * Determine if delivery is currently available.
     */
    public function isDeliveryAvailable(): bool
    {
        return $this->has_delivery && $this->delivery_status === 'available';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating') ?: 0, 1);
    }
}