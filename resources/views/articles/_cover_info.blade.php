<div class="col-md-6" style="margin-bottom:20px;">
    <hr>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('articles.show', $article->id) }}"><img src="{{ $article->cover }}" alt="" class="img-responsive"></a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('articles.show', $article->id) }}"><p style="margin-bottom:0;white-space: nowrap;overflow:hidden"><b>{{ $article->title }}</b></p></a>
            <p style="color:#BEBEBE;max-height:44px;overflow:hidden;">{{ $article->intro }}</p>
            <p><span class="glyphicon glyphicon-play-circle"></span> {{ $article->view }} <span class="glyphicon glyphicon-edit"></span> {{ $article->comment }}</p>
        </div>
    </div>
</div>
