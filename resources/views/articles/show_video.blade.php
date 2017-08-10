@extends('layouts.app_imax')

@section('title', '详情')

@section('content_under')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $article->title }}</h2>
            <p>作者：{{ $article->user->nickname }}<span style="margin-left:20px">浏览：{{ $article->view }}</span><span style="margin-left:20px">评论：{{ $article->comment }}</span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <video src="/video/default.mp4" controls="controls" width="100%" poster="/img/default.jpg">
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
