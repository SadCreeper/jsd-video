<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function home()
    {
        //获取 TOP 全部文章前9个
        $articles_top = Article::filterArticlesSmartHot('view',9);
        //获取热评文章
        $articles_hot = Article::filterArticlesSmartHot('comment',7);

        //TODO 获取分类文章
        $categories = Category::all();
        //dump($categories);
        $articles_category = [];
        for ($i=0; $i < sizeof($categories); $i++) {
            $articles_category[$i]['category_id'] = $categories[$i]['id'];
            $articles_category[$i]['category_name'] = $categories[$i]['name'];
            $articles_category[$i]['data'] = Article::filterArticlesSmartHot('view',7,$categories[$i]['id']);
        }
        return view('home', compact('articles_top', 'articles_hot', 'articles_category'));
    }

    public function list()
    {
        return view('list');
    }
}
