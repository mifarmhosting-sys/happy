<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description1',
        'description2',
        'description3',
        'amenities_title',
        'amenities_description',
        'amenities_image_path',
        'offers_title',
        'offers_description',
        'offers_image_path',
        'about_image1_path',
        'about_image2_path',
    ];
}
