<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'restaurant_id',
        'amount',
        'status',
        'reference_number',
        'notes',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
