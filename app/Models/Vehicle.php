<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'make',
        'model',
        'license_plate',
        'vehicle_category_id',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    public function vehicle_category()
    {
        return $this->belongsTo(Vehicle_category::class, 'vehicle_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
