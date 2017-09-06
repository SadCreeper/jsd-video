<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
        'phone',
        'gender',
        'avatar',
        'motto',
        'isAdmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //一个用户包含多个文章
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * 用户点赞过的文章
     */
    public function articles_praise()
    {
        return $this->belongsToMany('App\Models\Article', 'praises', 'user_id', 'article_id');
    }
}
