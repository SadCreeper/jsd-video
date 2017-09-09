@extends('layouts.app_imax')

@section('title', '详情')

@section('content_under')
<div class="container">

    @include('articles._show_info')

    <div class="row">
        <div class="col-md-8">
            <video src="http://z970-images.oss-cn-shanghai.aliyuncs.com/{{$article->video}}" style="max-height:400px" controls="controls" width="100%" poster="{{ $article->cover }}">
                您的浏览器不支持视频播放。
            </video>
        </div>
        <div class="col-md-4">
            <h4>18798 人正在看</h4>
            <p style="background-color:#CFCFCF">01:51 我要 这变化又如何</p>
            <p style="background-color:#CFCFCF">00:24 月溅星河</p>
            <p style="background-color:#CFCFCF">00:28 月溅星河，长夜漫漫</p>
            <p style="background-color:#CFCFCF">01:34 大圣是我永恒的男神！</p>
            <p style="background-color:#CFCFCF">01:52 我有这变化又如何</p>
            <p style="background-color:#CFCFCF">01:51 我要 这变化又如何</p>
            <p style="background-color:#CFCFCF">00:24 月溅星河</p>
            <p style="background-color:#CFCFCF">00:28 月溅星河，长夜漫漫</p>
            <p style="background-color:#CFCFCF">01:34 大圣是我永恒的男神！</p>
            <p style="background-color:#CFCFCF">01:52 我有这变化又如何</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h4>评论</h4>
        </div>
    </div>
</div>
@endsection
