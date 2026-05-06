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
    ];

    protected $casts = [
        'facilities' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function getBudgetRangeAttribute()
    {
        $avgPrice = $this->menus()->avg('price');

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
}