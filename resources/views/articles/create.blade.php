@extends('users.user_app')

@section('title', '我要上传')

@section('nickname', Auth::user()->nickname)

@section('motto', Auth::user()->motto)

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
      <form class="form-horizontal" method="post" action="{{ route('articles.store') }}">
          {{ csrf_field() }}
          @include('articles._form')
          <div class="form-group">
              <label for="video" class="col-sm-2 control-label">选择视频</label>
              <div class="col-sm-10">
                  <input type="file" class="form-control" name="video" value="">
              </div>
          </div>
          <button type="submit" class="btn btn-primary col-md-offset-2">确认上传</button>
      </form>
  </div>
  <div role="tabpanel" class="tab-pane" id="albumTab">
      <form class="form-horizontal" method="post" action="{{ route('articles.store') }}">
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
<script type="text/javascript">
//标签页JS
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
@endsection
