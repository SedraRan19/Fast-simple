<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use SoftDeletes,HasFactory;
    
    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];
    public $timestamps = true;

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}

