<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;
use Auth;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index', 'manage', 'create','store']
        ]);
    }
    //文章分类页
    public function category($id)
    {
        $category = Category::findOrFail($id);
        return view('articles.category', compact('category'));
    }
    //文章管理页
    public function manage()
    {
        //验证登录用户是否为管理员
        $this->authorize('admin', Auth::user());
        $articles = Article::paginate(20);
        return view('articles.manage', compact('articles'));
    }
    //我的上传
    public function index()
    {
        $user_id = Auth::id();
        $articles = Article::where('user_id', $user_id)->paginate(20);
        return view('articles.index', compact('articles'));
    }
    //展示页
    public function show($id)
    {
        $article = Article::findOrFail($id);
        if ($article->type == 1) {
            return view('articles.show_video', compact('article'));
        }
        if ($article->type == 2) {
            return view('articles.show_album', compact('article'));
        }

    }
    //上传页
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }
    //上传
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:50',
        ]);

        //保存文章数据
        if ($request->has('video')) {
            $type = 1;
        }
        if ($request->has('photo')) {
            $type = 2;
        }
        $article = Article::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'title' => $request->title,
            'category_id' => $request->category,
            'cover' => 'img/default.jpg',
            'intro' => $request->intro,
        ]);

        session()->flash('success', '上传成功！');
        return back();
    }
    //编辑
    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);
        return view('articles.edit', compact('categories', 'article'));
    }

    public function update(Request $request, $id)
    {
        //验证数据
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:50',
        ]);

        //取数据
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);

        //更新文章数据
        $data = [];
        $data['title'] = $request->title;
        $data['category_id'] = $request->category;
        $data['intro'] = $request->intro;
        if ($request->has('video')) {

        }
        if ($request->has('photo')) {

        }
        $article->update($data);

        session()->flash('success', '更新成功！');
        return back();
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);
        $article->delete();
        session()->flash('success', '删除成功！');
        return back();
    }
}
