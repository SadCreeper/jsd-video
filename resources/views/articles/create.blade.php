@extends('users.user_app')

@section('title', '我要上传')

@section('nickname', Auth::user()->nickname)

@section('motto', Auth::user()->motto)

@section('styles')
<style media="screen">
.btn{
    color: #fff;
    background-color: #337ab7;
    border-color: #2e6da4;
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    text-decoration: none;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
a.btn:hover{
  background-color: #3366b7;
}
.progress{
    margin-top:2px;
    width: 200px;
    height: 14px;
    margin-bottom: 10px;
    overflow: hidden;
    background-color: #f5f5f5;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
}
.progress-bar{
    background-color: rgb(92, 184, 92);
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.14902) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.14902) 50%, rgba(255, 255, 255, 0.14902) 75%, transparent 75%, transparent);
    background-size: 40px 40px;
    box-shadow: rgba(0, 0, 0, 0.14902) 0px -1px 0px 0px inset;
    box-sizing: border-box;
    color: rgb(255, 255, 255);
    display: block;
    float: left;
    font-size: 12px;
    height: 20px;
    line-height: 20px;
    text-align: center;
    transition-delay: 0s;
    transition-duration: 0.6s;
    transition-property: width;
    transition-timing-function: ease;
    width: 266.188px;
}
</style>
@endsection

@section('user_content')
<h2>我要上传</h2>

@include('shared.errors')
@include('shared.messages')

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#videoTab" aria-controls="editTab" role="tab" data-toggle="tab">上传视频</a></li>
  <li role="presentation"><a href="#albumTab" aria-controls="previewTab" role="tab" data-toggle="tab" id="previewButton">上传图片</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="videoTab">
      <form class="form-horizontal" method="post" action="{{ route('articles.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <h4>您所选择的文件列表：</h4>
          <div id="ossfile">你的浏览器不支持flash,Silverlight或者HTML5！</div>

          <br/>

          <div id="container">
          	<a id="selectfiles" href="javascript:void(0);" class='btn'>选择文件</a>
          	<a id="postfiles" href="javascript:void(0);" class='btn'>开始上传</a>
          </div>

          <pre id="console"></pre>

          <div class="form-group">
              <label for="video" class="col-sm-2 control-label">选择视频</label>
              <div class="col-sm-10">
                  <input type="file" class="form-control" name="video" value="">
              </div>
          </div>
          @include('articles._form')
          <button type="submit" class="btn btn-primary col-md-offset-2">保存</button>
      </form>
  </div>
  <div role="tabpanel" class="tab-pane" id="albumTab">
      <form class="form-horizontal" method="post" action="{{ route('articles.store') }}"  enctype="multipart/form-data">
          {{ csrf_field() }}
          @include('articles._form')
          <div class="form-group">
              <label for="photo" class="col-sm-2 control-label">添加图片</label>
              <div class="col-sm-10">
                  <input type="file" class="form-control" name="photo" value="">
              </div>
          </div>
          <button type="submit" class="btn btn-primary col-md-offset-2">确认上传</button>
      </form>
  </div>
</div>


@endsection

@section('scripts')
<!-- 标签页JS -->
<script type="text/javascript">
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
<!-- 上传 -->
<script type="text/javascript" src="/js/upload/plupload.full.min.js"></script>
<script type="text/javascript" src="/js/upload/upload.js"></script>

@endsection
