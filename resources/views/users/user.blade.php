@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:30px">
        <div class="col-md-3">
            <div class="" >
                <img src="/img/default.jpg" alt="" style="width:100%">
                <h4>@yield('nickname', '-')</h4>
                <p>@yield('motto', '-')</p>
                <ul class="list-group">
                  <li class="list-group-item"><a href="{{ route('users.edit', Auth::id()) }}">个人设置</a></li>
                  <li class="list-group-item"><a href="#">我要上传</a></li>
                  <li class="list-group-item"><a href="#">我的上传</a></li>
                  <li class="list-group-item"><a href="#">我的收藏</a></li>
                  <li class="list-group-item"><a href="#">我的关注</a></li>
                  <li class="list-group-item"><a href="#">作品管理</a></li>
                  <li class="list-group-item"><a href="#">用户管理</a></li>
                  <li class="list-group-item"><a href="#">网站设置</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            @yield('user_content')
        </div>
    </div>
</div>
@endsection
