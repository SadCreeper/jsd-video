@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding-top:30px;padding-bottom:30px">
        <div class="col-md-6 col-md-offset-3">
            <form class="" action="{{ route('articles.search') }}" method="post">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="key" placeholder="输入关键词进行搜索">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">搜索</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($articles as $article)
            @include('articles._cover_info_vertical')
        @endforeach
    </div>
    {{ $articles->links() }}
</div>
@endsection
