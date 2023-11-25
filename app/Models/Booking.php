<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from_location',
        'to_location',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'trip_date',
        'passenger_count',
        'passenger_phone',
        'passenger_name',
        'flight',
        'price',
        'google_calendar_event_id',
        'duration',
        'status',
        'refund_status',
        'charge_status',
        'add_disclaimer',
        'comments',
        'user_id',
        'customer_id',
        'vehicle_category_id',
        'vehicle_id',
        'driver_id',
        'driver_payout',
    ];

    protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vehicle_category()
    {
        return $this->belongsTo(Vehicle_category::class, 'vehicle_category_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    // public function dateForma()
    // {
    //     return $this->start_time->format('d/m/Y');
    // }
}
