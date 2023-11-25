<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory,softDeletes;
    protected $fillable = [
        'user_id',
        'smtp_host',
        'smtp_username',
        'smtp_password',
        'smtp_port',
        'smtp_address',
        'stripe_public_key',
        'stripe_secret_key',
        'cancellation_policy',
        'disclaimer_policy',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
