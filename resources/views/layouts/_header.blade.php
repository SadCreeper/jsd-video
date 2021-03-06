{{-- 这是导航栏--}}
<nav class="navbar navbar-default navbar-fixed-top" style="margin-bottom:0">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">首页</a>
            <form class="navbar-form navbar-right hidden-lg hidden-md hidden-sm" style="margin:0;border:0;padding:8px 25% 0 25%" action="{{ route('articles.search') }}" method="post">
                {{ csrf_field() }}
                <!-- <div class="form-group">
                    <input type="text" class="form-control" name="key" placeholder="请输入">
                </div>
                <button type="submit" class="btn btn-default">搜索</button> -->
                <div class="input-group">
                    <input type="text" class="form-control" name="key" placeholder="请输入">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">搜索</button>
                    </span>
                </div>
            </form>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($category_header as $category)
                    <li class="hidden-xs"><a href="{{ route('articles.category', $category->id) }}">{{ $category->name }}</a></li>
                    <li class="col-xs-4 hidden-lg hidden-md hidden-sm"><a href="{{ route('articles.category', $category->id) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar  }}" alt="" class="img-circle" style="width:25px;height:25px"> {{ Auth::user()->nickname }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('users.edit', Auth::id()) }}">个人设置</a></li>
                          <li><a href="{{ route('articles.create') }}">我要上传</a></li>
                          <li><a href="{{ route('articles.index') }}">我的上传</a></li>
                          <li><a href="{{ route('articles.praised') }}">我赞过的</a></li>
                          <!-- <li><a href="#">我的收藏</a></li> -->
                          <!-- <li><a href="#">我的关注</a></li> -->
                          @if(Auth::user()->isAdmin)
                              <li><a href="{{ route('articles.manage') }}">作品管理</a></li>
                              <li><a href="{{ route('users.index') }}">用户管理</a></li>
                          @endif
                          @if(Auth::id() == 1)
                              <li><a href="{{ route('users.config') }}">网站设置</a></li>
                          @endif
                          <li role="separator" class="divider"></li>
                          <li><a id="signOutBtn" href="javascript:0">退出登录</a></li>
                          <li>
                              <form id="signOutForm" action="{{ route('logout') }}" method="POST" style="display:none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button type="submit" name="button"></button>
                              </form>
                          </li>
                      </ul>
                    </li>
                    <li><a href="{{ route('articles.create') }}">上传</a></li>
                @else
                    <li><a href="" data-toggle="modal" data-target="#signIn">登录</a></li>
                    <li><a href="" data-toggle="modal" data-target="#signUp">注册</a></li>
                    <li><a href="" id="uploadBtn" onclick="return false">上传</a></li>
                @endif
            </ul>
            <form class="navbar-form navbar-right hidden-xs" action="{{ route('articles.search') }}" method="post">
                {{ csrf_field() }}
                <!-- <div class="form-group">
                    <input type="text" class="form-control" name="key" placeholder="请输入">
                </div>
                <button type="submit" class="btn btn-default">搜索</button> -->
                <div class="input-group">
                    <input type="text" class="form-control" name="key" placeholder="请输入">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">搜索</button>
                    </span>
                </div>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div style="margin-top:50px"></div>

<!-- 登录模态框 -->
<div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content z-modal">
      <div class="modal-header z-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">登录</h4>
      </div>
      <div class="modal-body">
          <div id="signInWarn" class="alert alert-danger" style="display:none">
              <!-- AJAX 返回信息 -->
          </div>
          <div id="signInInfo" class="alert alert-info" style="display:none">
              <!-- AJAX 返回信息 -->
          </div>
          <form id="signInForm">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="text" name="phone" class="form-control" placeholder="手机" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="登录密码" value="{{ old('password') }}">
            </div>

            <div class="checkbox">
            <label><input type="checkbox" name="remember"> 记住我</label>
          </div>
        </form>
      </div>
      <div class="modal-footer z-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="signInBtn" type="button" class="btn btn-primary">登录</button>
      </div>
    </div>
  </div>
</div>

<!-- 注册模态框 -->
<div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content z-modal">
      <div class="modal-header z-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">注册</h4>
      </div>
      <div class="modal-body">
          <div id="signUpWarn" class="alert alert-danger" style="display:none">
              <!-- AJAX 返回信息 -->
          </div>
          <div id="signUpInfo" class="alert alert-info" style="display:none">
              <!-- AJAX 返回信息 -->
          </div>
          <form id="signUpForm" onsubmit="return false()">
              {{ csrf_field() }}
            <div class="form-group">
              <input type="text" name="nickname" class="form-control" placeholder="昵称" value="{{ old('name') }}">
            </div>

            <div class="form-group">
              <input type="text" id="phone" name="phone" class="form-control" placeholder="手机" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input type="text" name="verify" class="form-control" placeholder="验证码">
                    <span class="input-group-btn">
                        <button id="verifyCodeBtn" class="btn btn-default" type="button">获取验证码</button>
                        <button id="verifyCodeBtnWait" class="btn btn-default" style="display:none" type="button" disabled></button>
                    </span>
                </div>
            </div>

            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="密码（6-16位字母、数字和符号）" value="{{ old('password') }}">
            </div>

            <div class="form-group">
              <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码" value="{{ old('password_confirmation') }}">
            </div>
          </form>
      </div>
      <div class="modal-footer z-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button id="signUpBtn" type="button" class="btn btn-primary">注册</button>

      </div>
    </div>
  </div>
</div>
