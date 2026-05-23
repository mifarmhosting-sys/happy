<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'contact_email',
        'contact_phone',
        'contact_address',
        'working_hours',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'logo_path',
        'footer_logo_path',
        'footer_blurb',
    ];
}
