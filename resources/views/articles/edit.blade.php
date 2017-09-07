@extends('users.user_app')

@section('title', '编辑上传')

@section('user_content')
<h2>编辑上传</h2>

@include('shared.errors')
@include('shared.messages')

<!-- Tab panes -->
    @if($article->type == 1)
        <form class="form-horizontal" method="post" action="{{ route('articles.update', $article->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="video" class="col-sm-2 control-label">视频</label>
                <div class="col-sm-10">
                    视频暂不支持编辑，<a href="{{ route('articles.show', $article->id) }}" target="_blank">点此查看视频</a>
                </div>
            </div>
            @include('articles._form')
            <button type="submit" class="btn btn-primary col-md-offset-2">确认更新</button>
        </form>
    @elseif($article->type == 2)

        <form class="form-horizontal" method="post" action="{{ route('articles.update', $article->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="video" class="col-sm-2 control-label">相册</label>
                <div class="col-sm-10">
                    相册暂不支持编辑，<a href="{{ route('articles.show', $article->id) }}" target="_blank">点此查看相册</a>
                </div>
            </div>
            @include('articles._form')
            <button type="submit" class="btn btn-primary col-md-offset-2">确认更新</button>
        </form>
    @endif



@endsection
