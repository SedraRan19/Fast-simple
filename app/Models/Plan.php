<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use SoftDeletes,HasFactory;

    protected $fillable = [
        'name',
        'price',
        'frequency',
        'no_of_users_included',
        'price_per_additional_user',
        'description',
    ];

    protected $dates = ['deleted_at'];


    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
