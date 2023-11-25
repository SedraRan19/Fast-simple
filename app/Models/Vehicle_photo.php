<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehiclePhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'image_type',
        'image',
    ];

    protected $dates = ['deleted_at'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
