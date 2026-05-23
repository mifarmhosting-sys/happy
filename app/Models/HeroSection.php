<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'eyebrow',
        'title',
        'subtitle',
        'video_path',
        'image_fallback_path',
    ];
}
