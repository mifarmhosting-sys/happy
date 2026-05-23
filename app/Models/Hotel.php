<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'rating',
        'location',
        'country',
        'description',
        'image_path',
        'view_url',
        'sort_order',
    ];

    public function categories()
    {
        return $this->belongsToMany(HotelCategory::class, 'category_hotel', 'hotel_id', 'category_id');
    }
}
