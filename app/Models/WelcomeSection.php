<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeSection extends Model
{
    protected $fillable = [
        'tagline',
        'title',
        'description1',
        'description2',
        'accent_text',
        'image1_path',
        'image2_path',
        'image3_path',
        'image4_path',
    ];
}
