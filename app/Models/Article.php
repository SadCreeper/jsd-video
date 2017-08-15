<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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

    //按分类获取文章
    //@ category_id  分类id
    //@ number       数量，不传为0，则取全部
    static function filterArticlesByCategory($category_id,$number=0)
    {
        if ($number == 0) {
            $articles = Article::where('category_id', $category_id)->paginate(20);
        }
        else {
            $articles = Article::where('category_id', $category_id)->limit($number)->get();
        }

        return $articles;
    }

    //智能获取文章 - 主要获取较热文章
    //（按字段、分类筛选一定时间段一定数量的文章）
    //@ order            排序，排序字段
    //@ number           数量，取的数量
    //@ category  （可选）分类，不传或为 0 则在全部文章中取
    static function filterArticlesSmartHot($order,$number,$category_id=0)
    {
        //获取多少天之内的文章
        $time = Carbon::now()->subDays(7);
        //过滤
        if ($category_id == 0) {
            $articles = Article::where('created_at', '>', $time)->orderBy($order, 'desc')->limit($number)->get();
        }else {
            $articles = Article::where('category_id',$category_id)->where('created_at', '>', $time)->orderBy($order, 'desc')->limit($number)->get();
        }
        return $articles;
    }
}
