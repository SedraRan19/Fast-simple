<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins
}
