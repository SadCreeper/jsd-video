@extends('layouts.app')

@section('title', '列表')

@section('content')
<div class="container">
    <div class="row" style="margin-top:30px">
        <div class="col-md-3">
            <div class="" >
                <img src="/img/default.jpg" alt="" style="width:100%">
                <h4>SadCreeper</h4>
                <p>生活可以随心所欲，但不能随波逐流</p>
                <ul class="list-group">
                  <li class="list-group-item">个人设置</li>
                  <li class="list-group-item">我要上传</li>
                  <li class="list-group-item">我的上传</li>
                  <li class="list-group-item">我的收藏</li>
                  <li class="list-group-item">我的关注</li>
                  <li class="list-group-item">作品管理</li>
                  <li class="list-group-item">用户管理</li>
                  <li class="list-group-item">网站设置</li>

                </ul>
            </div>
        </div>
        <div class="col-md-9" style="height:600px;background-color:gray">

        </div>
    </div>
</div>
@endsection
