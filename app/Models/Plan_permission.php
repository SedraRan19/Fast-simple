<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan_permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_id',
        'plan_id',
    ];

    public function permission(){
        return $this->belongsTo(Permission::class,'permission_id');
    }
    public function plan(){
        return $this->belongsTo(Permission::class,'plan_id');
    }
}
