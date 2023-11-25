<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission_role extends Model
{
    use HasFactory;

    protected $table = 'permission_roles';

    protected $fillable = [
        'role_id',
        'permission_id',
        'comment',
    ];

    // Autres méthodes, relations, etc., peuvent être ajoutées ici selon les besoins

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
