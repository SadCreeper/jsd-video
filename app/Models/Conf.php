<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table = 'conf';
    protected $fillable = [
        'key',
        'value',
        'intro',
    ];
}
