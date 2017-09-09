@extends('layouts.app_imax')

@section('title', '列表')

@section('content_under')

<div class="container">
    <!-- 分类 -->
    <div class="" style="height:50px">

    </div>

    <!-- 列表区 -->
    <div class="row">
        <!-- 左侧 -->
        <div class="col-md-9">
            <!-- 全部 -->
            <div class="row">
                @foreach($articles as $article)
                    @include('articles._cover_info')
                @endforeach
            </div>
            {{ $articles->links() }}
        </div>
        <!-- 右侧 -->
        <div class="col-md-3">
            <h4>热播排行</h4>
            @foreach($articles_hot as $article)
                <a href="{{ route('articles.show', $article->id) }}"><p style="white-space: nowrap;overflow:hidden"><span class="label label-danger">{{ $loop->iteration }}</span> {{ $article->title }}</p></a>
            @endforeach
        </div>
    </div>
</div>
@endsection
