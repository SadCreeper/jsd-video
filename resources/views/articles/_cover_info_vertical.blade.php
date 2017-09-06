<div class="col-md-3" style="margin-bottom:20px;height:300px">
    <a href="{{ route('articles.show', $article->id) }}"><img src="{{ $article->cover }}" alt="" class="img-responsive"></a>
    <a href="{{ route('articles.show', $article->id) }}"><p><b>{{ $article->title }}</b></p></a>
    <p style="color:#BEBEBE;max-height:50px;overflow:hidden;">{{ $article->intro }}</p>
    <p><span class="glyphicon glyphicon-play-circle"></span> {{ $article->view }} <span class="glyphicon glyphicon-edit"></span> {{ $article->comment }}</p>
</div>
