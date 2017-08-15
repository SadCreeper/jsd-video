@extends('layouts.app_imax')

@section('title', '详情')

@section('content_under')
<div class="container">
    <h2>{{ $article->title }}</h2>
    <p>作者：{{ $article->user->nickname }}<span style="margin-left:20px">浏览：{{ $article->view }}</span><span style="margin-left:20px">评论：{{ $article->comment }}</span></p>
    <div class="row masonry">
        @for ($i = 1; $i < 10; $i++)
        <div class="col-md-3 item" style="margin-bottom:20px">
            <img src="/img/{{ $i }}.jpg" alt="" style="width:100%">
        </div>
        @endfor
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
<!--瀑布流-->
<script>
$('.masonry').imagesLoaded(function() {
    $('.masonry').masonry({
    itemSelector: '.item'
    });
});
</script>
@endsection
