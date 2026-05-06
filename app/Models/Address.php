<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'label',
        'address_line',
        'city',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'is_primary',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
