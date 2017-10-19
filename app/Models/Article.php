<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Auth;

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
        'video',
        'photos',
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

    /**
     * 点赞过文章的用户
     */
    public function users_praise()
    {
        return $this->belongsToMany('App\Models\User', 'praises', 'article_id', 'user_id');
    }

    //按分类获取文章
    //@ category_id  分类id
    //@ number       数量，不传为0，则取全部
    static function filterArticlesByCategory($category_id,$number=0)
    {
        if ($number == 0) {
            $articles = Article::where('category_id', $category_id)->orderBy('created_at', 'desc')->paginate(20);
        }
        else {
            $articles = Article::where('category_id', $category_id)->orderBy('created_at', 'desc')->limit($number)->get();
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
        $time = Carbon::now()->subYear();
        //过滤
        if ($category_id == 0) {
            $articles = Article::where('created_at', '>', $time)->orderBy($order, 'desc')->limit($number)->get();
        }else {
            $articles = Article::where('category_id',$category_id)->where('created_at', '>', $time)->orderBy($order, 'desc')->limit($number)->get();
        }
        return $articles;
    }

    //当前用户是否点赞文章
    //
    // @ article_id
    //
    // return bool(true/false)
    static function isPraise($article_id)
    {
        $user = Auth::user();
        if(count($user->articles_praise()->where('article_id', $article_id)->get())){
            return true;
        }
        else {
            return false;
        }
    }

    //更新浏览量
    // @ article_id
    static public function update_view($id)
    {
        $article = Article::findOrFail($id);
        $article->view = $article->view + 1;
        $article->update([
            'view' => $article->view,
        ]);
    }
}
