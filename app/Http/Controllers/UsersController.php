<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;
use App\Models\PhoneVerification;
use Auth;
use GuzzleHttp\Client;

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
        //检查验证码
        $verification = PhoneVerification::where('phone',$request->phone)->first();
        if ($verification->verification != $request->verify) {
            //验证码不匹配
            return response()->json([
                'status' => 10001,
                'message' => '验证码不正确！'
            ]);
        }
        else {
            //通过验证码验证
            //验证数据
            $this->validate($request, [
                'nickname' => 'required|min:4|max:15',
                'phone' => 'required|digits:11|unique:users',
                'password' => 'required|confirmed|min:6|max:16',
            ]);

            //保存用户数据
            $user = User::create([
                'nickname' => $request->nickname,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
            ]);
            //注册成功自动登录
            Auth::login($user);
            return response()->json([
                'status' => 200,
                'message' => '注册成功！'
            ]);
        }
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
            'email' => 'email',
            'motto' => 'max:255',
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $data = [];
        $data['nickname'] = $request->nickname;
        $data['email'] = $request->email;
        $data['gender'] = $request->gender;
        $data['motto'] = $request->motto;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人设置更新成功！');

        return redirect()->route('users.edit', $id);
    }

    //发送验证码函数
    //@ phone : 要发送的手机号
    public function verify(Request $request)
    {
        //手机号格式验证
        $this->validate($request, [
            'phone' => 'required|digits:11',
        ]);
        //生成 6 位数字验证码
        $numberArr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $verify_code = "";
        for ($i=0; $i < 6; $i++) {
            $verify_code .= $numberArr[rand(0,9)];
        }
        //检查手机号是否存在
        $verification = PhoneVerification::where('phone',$request->phone)->first();
        if ($verification) {
            //存在：更新验证码
            $verification->verification = $verify_code;
            $verification->save();
        }else {
            //不存在，保存手机号和验证码
            PhoneVerification::create([
                'phone' => $request->phone,
                'verification' => $verify_code,
            ]);
        }

        //接口参数
        $url = 'http://114.55.141.65/msg/HttpSendSM';
        $account = 'chuanshan_JWWH';
        $pswd = 'SMS_mana9er';
        $needstatus = 'true';
        $mobile = $request->phone;
        $msg = '【君为】您的验证码是：'.$verify_code;

        //发送验证码
        $client = new Client;
        $response = $client->request('GET', $url, [
            'query' => [
                'account' => $account,
                'pswd' => $pswd,
                'mobile' => $mobile,
                'msg' => $msg,
                'needstatus' => $needstatus,
            ]
        ]);
        $responseStr = (string) $response->getBody();
        //$responseStr = "20110725160412,0";
        if ($responseStr[15] == 0) {
            return response()->json([
                'status' => 200,
                'message' => '发送成功！'
            ]);
        }else {
            return response()->json([
                'status' => 10001,
                'message' => '发送失败！'
            ]);
        }
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
