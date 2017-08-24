@extends('users.user_app')

@section('title', '个人设置')

@section('nickname', Auth::user()->nickname)

@section('motto', Auth::user()->motto)

@section('user_content')

    <h2>个人设置</h2>

    @include('shared.errors')
    @include('shared.messages')

    <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id )}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label for="nickname" class="col-sm-2 control-label">昵称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nickname" value="{{ $user->nickname }}">
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">手机</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
            </div>
        </div>

        <div class="form-group">
            <label for="gender" class="col-sm-2 control-label">性别</label>
            <div class="col-sm-10">
                <select class="form-control" name="gender">
                  <option value="" >保密</option>
                  <option value="1" <?php if ($user->gender == 1) echo "selected"; ?>>男</option>
                  <option value="2" <?php if ($user->gender == 2) echo "selected"; ?>>女</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="motto" class="col-sm-2 control-label">个性签名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="motto" value="{{ $user->motto }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>
@endsection
