@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:30px">
        <div class="col-md-3">
            <div class="" >
                <img src="{{ Auth::user()->avatar  }}" alt="" style="width:100%">
                <h4>{{ Auth::user()->nickname  }}</h4>
                <p>{{ Auth::user()->motto  }}</p>
                <ul class="list-group">
                  <li class="list-group-item"><a href="{{ route('users.edit', Auth::id()) }}">个人设置</a></li>
                  <li class="list-group-item"><a href="{{ route('articles.create') }}">我要上传</a></li>
                  <li class="list-group-item"><a href="{{ route('articles.index') }}">我的上传</a></li>
                  <li class="list-group-item"><a href="{{ route('articles.praised') }}">我赞过的</a></li>
                  <!-- <li class="list-group-item"><a href="#">我的收藏</a></li>
                  <li class="list-group-item"><a href="#">我的关注</a></li> -->
                  @if(Auth::user()->isAdmin)
                  <li class="list-group-item"><a href="{{ route('articles.manage') }}">作品管理</a></li>
                  <li class="list-group-item"><a href="{{ route('users.index') }}">用户管理</a></li>
                  @endif
                  @if(Auth::id() == 1)
                  <li class="list-group-item"><a href="{{ route('users.config') }}">网站设置</a></li>
                  @endif
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            @yield('user_content')
        </div>
    </div>
</div>
@endsection
