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

    public function getImageUrlAttribute()
    {
        $path = $this->image_path;
        if (!$path) {
            return asset('images/profile.jpg');
        }
        if (filter_var($path, FILTER_VALIDATE_URL) || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        if (file_exists(public_path($path))) {
            return asset($path);
        }
        return asset('storage/' . $path);
    }
}
