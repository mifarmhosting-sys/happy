<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Authenticatable
{
    use Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'customer_id',
        'password',
        'customer_name',
        'age',
        'co_customer_name',
        'co_customer_age',
        'kid_1_name',
        'kid_1_age',
        'kid_2_name',
        'kid_2_age',
        'address',
        'mobile_1',
        'mobile_2',
        'email',
        'membership_issue_date',
        'membership_expiry_date',
        'membership_category',
        'membership_terms',
        'profile_image_path',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'membership_issue_date' => 'date',
        'membership_expiry_date' => 'date',
    ];

    /**
     * Get all bookings associated with this member.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'member_id');
    }
}
