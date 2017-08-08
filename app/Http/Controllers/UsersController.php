<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;

class UsersController extends Controller
{
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
}
