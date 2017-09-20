<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Conf;

use Mail;
use App\Mail\Feedback;

class HomeController extends Controller
{
    public function home()
    {
        //获取 TOP 全部文章前9个
        $articles_top = Article::filterArticlesSmartHot('view',9);
        //获取热评文章
        $articles_hot = Article::filterArticlesSmartHot('comment',7);

        //获取分类文章
        $categories = Category::all();
        //dump($categories);
        $articles_category = [];
        for ($i=0; $i < sizeof($categories); $i++) {
            $articles_category[$i]['category_id'] = $categories[$i]['id'];
            $articles_category[$i]['category_name'] = $categories[$i]['name'];
            $articles_category[$i]['data'] = Article::filterArticlesSmartHot('view',7,$categories[$i]['id']);
        }

        //获取公告
        $notice = Conf::where('key','notice')->first()->value;

        return view('home', compact('articles_top', 'articles_hot', 'articles_category', 'notice'));
    }

    public function list()
    {
        return view('list');
    }

    //反馈信息
    public function feedback(Request $request)
    {
        $data['feedback'] = $request->feedback;
        $users = User::whereIn('id', [1,2])->get();
        Mail::to($users)->send(new Feedback($data));
        return response()->json([
            'status' => '200',
            'message' => "发送成功",
        ]);
    }
}
