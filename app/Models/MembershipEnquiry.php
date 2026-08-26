<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipEnquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];
}
