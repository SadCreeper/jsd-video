<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneVerification extends Model
{
    protected $table = 'phone_verifications';
    protected $fillable = [
        'phone',
        'verification',
    ];
}
