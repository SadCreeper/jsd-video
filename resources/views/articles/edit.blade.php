@extends('users.user_app')

@section('title', '编辑上传')

@section('nickname', Auth::user()->nickname)

@section('motto', Auth::user()->motto)

@section('user_content')
<h2>编辑上传</h2>

@include('shared.errors')
@include('shared.messages')

<!-- Tab panes -->
    @if($article->type == 1)
        <form class="form-horizontal" method="post" action="{{ route('articles.update', $article->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            @include('articles._form')
            <div class="form-group">
                <label for="video" class="col-sm-2 control-label">选择视频</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="video" value="">
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-md-offset-2">确认更新</button>
        </form>
    @elseif($article->type == 2)

        <form class="form-horizontal" method="post" action="{{ route('articles.update', $article->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            @include('articles._form')
            <div class="form-group">
                <label for="photo" class="col-sm-2 control-label">添加图片</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="photo" value="">
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-md-offset-2">确认更新</button>
        </form>
    @endif



@endsection
