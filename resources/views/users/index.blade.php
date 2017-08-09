@extends('users.user_app')

@section('title', '用户管理')

@section('nickname', Auth::user()->nickname)

@section('motto', Auth::user()->motto)

@section('user_content')
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="success">
                <th>ID</th>
                <th>昵称</th>
                <th>邮箱</th>
                <th>手机</th>
                <th>性别</th>
                <th>注册时间</th>
                <th>用户组</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nickname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>@if($user->gender == 1) 男 @elseif($user->gender == 2) 女 @else 保密 @endif</td>
                    <td>{{ $user->created_at }}</td>
                    <td>@if($user->id ==1) 站长 @elseif($user->isAdmin == 1) 管理员 @elseif($user->isAdmin == 0) 用户 @endif</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
