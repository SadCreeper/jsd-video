<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class SessionsController extends Controller
{
    // AJAX 登录
    public function store(Request $request)
    {
       $this->validate($request, [
           'phone' => 'required|digits:11',
           'password' => 'required'
       ]);

       $credentials = [
           'phone'    => $request->phone,
           'password' => $request->password,
       ];

       if (Auth::attempt($credentials, $request->has('remember'))) {
           // 登录成功后的相关操作
           return response()->json([
               'status' => 200,
               'message' => '登录成功！'
           ]);
       } else {
           // 登录失败后的相关操作
           return response()->json([
               'status' => 10001,
               'message' => '手机号或登录密码不正确！'
           ]);
       }
    }

    //退出登录
    public function destroy()
    {
       Auth::logout();
       return redirect('/');
    }
}
