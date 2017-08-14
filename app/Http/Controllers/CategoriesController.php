<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Article;
use Auth;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['store', 'update']
        ]);
    }
    //新增
    public function store(Request $request)
    {
        //验证登录用户是否为站长
        $this->authorize('super', Auth::user());
        //保存用户数据
        $category = Category::create([
            'name' => $request->name,
        ]);
        return back();
    }
    //AJAX 编辑分类
    public function update(Request $request, $id)
    {
        //验证登录用户是否为站长
        $this->authorize('super', Auth::user());
        //验证数据
        $this->validate($request, [
            'order' => 'integer',
            'name' => 'max:8',
        ]);
        //取数据
        $category = Category::findOrFail($id);
        //更新数据
        $data = [];
        if ($request->order) {
            $data['order'] = $request->order;
        }
        if ($request->name) {
            $data['name'] = $request->name;
        }
        $category->update($data);
        //返回
        return response()->json([
            'status' => 200,
            'message' => '保存成功！'
        ]);
    }
    //删除分类
    public function destroy($id)
    {
        //验证登录用户是否为站长
        $this->authorize('super', Auth::user());
        //TODO 检查分类下是否还有文章
        $articles = Article::filterArticlesByCategory($id);
        if (sizeof($articles)) {
            session()->flash('danger', '请先删除该分类下全部上传！');
        }
        else {
            $category = Category::findOrFail($id);
            $category->delete();
            session()->flash('success', '删除成功！');
        }
        return back();
    }
}
