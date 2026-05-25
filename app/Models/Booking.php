<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'member_id',
        'extra_member_name',
        'extra_member_age',
        'journey_start_date',
        'journey_end_date',
        'journey_tenure',
        'destination_type',
        'destination_details',
        'opt_ticket',
        'opt_pickup_drop',
        'opt_sightseeing',
        'opt_food',
        'status',
    ];

    protected $casts = [
        'journey_start_date' => 'date',
        'journey_end_date' => 'date',
    ];

    /**
     * Get the member that owns the booking.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
