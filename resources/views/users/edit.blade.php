@extends('users.user_app')

@section('title', '个人设置')

@section('user_content')

    <h2>个人设置</h2>

    @include('shared.errors')
    @include('shared.messages')
    <form class="form-horizontal" action="{{ route('users.avatar') }}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="nickname" class="col-sm-2 control-label">头像</label>
            <div class="col-sm-10">
                <a href="" onclick="return false;" data-toggle="modal" data-target="#uploadAvatar"><img src="{{ $user->avatar }}" alt="" class="img-circle" style="height:100px"></a>
                <!-- Modal -->
                <div class="modal fade" id="uploadAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">更新头像</h4>
                      </div>
                          <div class="modal-body">
                            <img src="{{ $user->avatar }}" alt="" class="img-responsive">
                            <input type="file" name="avatar" style="margin-top:20px">
                            <p class="help-block">最佳像素 200*200</p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">确定</button>
                          </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </form>
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
                  <option value="0" >保密</option>
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
