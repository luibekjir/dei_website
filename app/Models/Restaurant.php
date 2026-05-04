
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'budget_range',
        'category',
        'description',
        'image',
        'address',
        'rating',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}

