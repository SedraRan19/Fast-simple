<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'home_address',
        'office_address',
        'permanent_note',
        'private_general_notes',
        'driver_notes',
        'user_id',
        'parent_id',
        'strip_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
