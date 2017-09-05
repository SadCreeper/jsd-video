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
<link href="/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="/js/upload/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" rel="stylesheet">
@endsection

@section('user_content')
<h2>我要上传</h2>

@include('shared.errors')
@include('shared.messages')
<div id="uploadWarn" class="alert alert-danger" style="display:none"></div>
<div id="uploadInfo" class="alert alert-success" style="display:none"></div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#videoTab" aria-controls="editTab" role="tab" data-toggle="tab">上传视频</a></li>
  <li role="presentation"><a href="#albumTab" aria-controls="previewTab" role="tab" data-toggle="tab" id="previewButton">上传图片</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="videoTab">
      <form id="videoForm" class="form-horizontal">
          {{ csrf_field() }}
          <div class="form-group">
              <div class="col-md-10 col-md-offset-2">
                  <div id="ossfile">你的浏览器不支持flash,Silverlight或者HTML5！</div>
              </div>
          </div>
          <div id="container" class="form-group">
              <div class="col-md-10 col-md-offset-2">
                  <a id="selectfiles" href="javascript:void(0);" class='btn'> <b>+</b> 添加视频</a>
              </div>
          </div>
          <!-- <pre id="console"></pre> -->
          <input type="hidden" class="form-control" id="video" name="video">
          @include('articles._form')
          <button type="button" id="videoFormBtn" class="btn btn-primary col-md-offset-2" disabled>提交</button>
      </form>
  </div>
  <div role="tabpanel" class="tab-pane" id="albumTab">
      <form class="form-horizontal" method="post" action="{{ route('articles.store') }}"  enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
              <label for="photo" class="col-sm-2 control-label">添加图片</label>
              <div class="col-sm-10">
                  <div id="photosUpload">
                      <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                  </div>
              </div>
          </div>
          <input type="hidden" class="form-control" id="photos" name="photos">

          @include('articles._form')
          <button type="submit" class="btn btn-primary col-md-offset-2">提交</button>
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

<script type="text/javascript" src="/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/upload/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="/js/upload/plupload/jquery.ui.plupload/jquery.ui.plupload.min.js"></script>
<script type="text/javascript" src="/js/upload/upload.js"></script>
<script type="text/javascript" src="/js/upload/plupload/i18n/zh_CN.js"></script>

<!-- 提交表单 -->
<script type="text/javascript">
$("button#videoFormBtn").click(function(){
    //var form_data = $("form#videoForm").serialize()
    var form_data = new FormData($('#videoForm')[0]);
    result = $.ajax({
        url:"{{ route('articles.store') }}",
        type:"POST",
        // headers:{
        //     'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        // },
        data:form_data,
        processData: false,
        contentType: false,
        success:function($mes){
            //成功 进一步判断
            if ($mes.status == 10001) {

                console.log($mes)
                $("#uploadWarn").show()
                $("#uploadWarn").html($mes.message)
            }else if ($mes.status == 200) {

                console.log($mes)
                $("#uploadWarn").hide()
                $("#uploadInfo").show()
                $("#uploadInfo").html($mes.message)
                //window.location.href="/"
            }
            console.log($mes)
        },
        error:function($err){
            if ($err.status == 500) {
                var uploadWarn = "服务器错误！"
            }else {
                //失败 打印返回信息
                console.log($err)
                $err = JSON.parse($err.responseText)
                var uploadWarn = "";
                for (var i in $err) {
                    uploadWarn += "<li>"+$err[i]+"</li>"
                }
            }
            $("#uploadWarn").show()
            $("#uploadWarn").html(uploadWarn)
        },
    });
})
</script>

<!-- 照片上传 -->
<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
    var photos = [];
    var uploader_photo = $("#photosUpload").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : "/upload-photo",
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },

        // Maximum file size
        max_file_size : '2mb',

        chunk_size: '1mb',

        // Resize images on clientside if we can
        resize : {
            //width : 200,
            //height : 200,
            quality : 90,
            crop: true // crop to exact dimensions
        },

        // Specify what files to browse for
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
        ],

        // Rename files by clicking on their titles
        rename: true,

        // Sort files
        sortable: true,

        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,

        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },

        // Flash settings
        flash_swf_url : '/plupload/js/Moxie.swf',

        // Silverlight settings
        silverlight_xap_url : '/plupload/js/Moxie.xap',
    });
    uploader_photo.bind('uploaded', function (up, file, status) {
        var res = JSON.parse(file.result.response);
        photos.push(res.name)
        //console.log(photos)
        $("input#photos").val(photos)
    });

});
</script>
@endsection
