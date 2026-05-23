<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon_svg',
    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'category_hotel', 'category_id', 'hotel_id');
    }
}
