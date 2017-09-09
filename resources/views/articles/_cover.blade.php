<div class="col-md-4 col-xs-6 z-padding-phone" style="margin-bottom:30px">
    <a href="{{ route('articles.show', $article->id) }}"><img src="{{ $article->cover }}" alt="" class="img-responsive"></a>

    <div class="hidden-lg hidden-md hidden-sm">
        <p class="z-img-bottom-bar"><span class="glyphicon glyphicon-play-circle" style="margin-left:5px"></span> {{ $article->view }} <span class="glyphicon glyphicon-edit" style="margin-left:5px"></span> {{ $article->comment }}</p>
        <p style="height:44px;overflow:hidden;margin-bottom:0">{{ $article->title }}</p>
    </div>
</div>
