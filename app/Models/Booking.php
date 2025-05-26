<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'customer_name',
        'phone_number',
        'service_id',
        'schedule_time',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'schedule_time' => 'datetime',
        ];
    }

     /**
     * Get the service of the booking.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
