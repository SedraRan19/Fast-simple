<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'card_number',
        'card_holder_name',
        'expiration_date',
        'cvv',
        'zip',
        'user_id',
        'customer_id',
        'driver_id',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le client
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relation avec le conducteur (driver)
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
