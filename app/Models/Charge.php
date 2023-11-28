<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'amount',
        'client_secret',
        'confirmation_method',
        'customer',
        'user_id',
        'customer_id',
        'payment_method',
        'charges_id',
        'card_id',
        'trip_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function trip()
    {
        return $this->belongsTo(Booking::class);
    }
}
