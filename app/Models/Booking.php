<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'customer_name',
        'email',
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
            'status' => BookingStatus::class,
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
