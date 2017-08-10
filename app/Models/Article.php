<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'category_id',
        'title',
        'cover',
        'intro',
        'view',
        'comment',
        'status',
    ];

    //一个文章属于一个用户
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //一个文章属于一个分类
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
