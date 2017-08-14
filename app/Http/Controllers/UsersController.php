<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index', 'edit', 'update', 'config']
        ]);
    }
    //用户管理页
    public function index()
    {
        //验证登录用户是否为管理员
        $this->authorize('admin', Auth::user());
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }
    //用户信息页
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    //注册 AJAX
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request, [
            'nickname' => 'required|min:4|max:15',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6|max:16',
        ]);

        //保存用户数据
        $user = User::create([
            'nickname' => $request->nickname,
            'password' => bcrypt($request->password),
            'email' => $request->email,
        ]);
        //注册成功自动登录
        Auth::login($user);
        return response()->json([
            'status' => 200,
            'message' => '注册成功！'
        ]);
    }

    //用户编辑页
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //用户编辑
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nickname' => 'required|min:4|max:15',
            'password' => 'confirmed|min:6|max:16',
            'phone' => 'integer',
            'motto' => 'max:255',
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $data = [];
        $data['nickname'] = $request->nickname;
        $data['phone'] = $request->phone;
        $data['gender'] = $request->gender;
        $data['motto'] = $request->motto;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人设置更新成功！');

        return redirect()->route('users.edit', $id);
    }

    public function config()
    {
        //验证登录用户是否为站长
        $this->authorize('super', Auth::user());
        //获取分类信息
        $categories = Category::orderBy('order')->get();
        return view('users.config', compact('categories'));
    }

}
