<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver_vehicle_category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'driver_id',
        'vehicle_category_id',
        'name',
        'price_per_hour',
        'price_per_mile',
        'base_price',
        'included',
        'percentage',
        'payout_calculation',
    ];

    protected $dates = ['deleted_at'];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle_category()
    {
        return $this->belongsTo(Vehicle_category::class);
    }

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
