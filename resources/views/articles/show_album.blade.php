@extends('layouts.app_imax')

@section('title', '详情')

@section('content_under')
<div class="container">
    <h2>{{ $article->title }}</h2>
    <p>作者：{{ $article->user->nickname }}<span style="margin-left:20px">浏览：{{ $article->view }}</span><span style="margin-left:20px">评论：{{ $article->comment }}</span></p>
</div>
@endsection
