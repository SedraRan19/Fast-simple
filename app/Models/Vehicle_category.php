<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle_category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price_per_hour',
        'price_per_mile',
        'base_price',
        'miles_inclided',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
