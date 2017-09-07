@extends('users.user_app')

@section('title', '作品管理')

@section('user_content')
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="success">
                <th>ID</th>
                <th>作者</th>
                <th>类型</th>
                <th>标题</th>
                <th>分类</th>
                <th>封面图片</th>
                <th>浏览量</th>
                <th>评论量</th>
                <th>创建时间</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->user->nickname }}</td>
                    <td>@if($article->type == 1) 视频 @elseif($article->type == 2) 相册 @endif</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td><img src="{{ $article->cover }}" alt="" style="width:50px"></td>
                    <td>{{ $article->view }}</td>
                    <td>{{ $article->comment }}</td>
                    <td>{{ $article->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
@endsection
