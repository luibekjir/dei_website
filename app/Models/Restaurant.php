
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'budget_range',
        'category_id',
        'description',
        'image',
        'address',
        'rating',
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class); 
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}

