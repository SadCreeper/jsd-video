<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'order',
        'name',
    ];

    //一个分类包含多个文章
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
