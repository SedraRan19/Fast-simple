<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver_payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'booking_id',
        'type',
        'amount',
        'payment_date',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
