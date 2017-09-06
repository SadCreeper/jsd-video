<div class="row">
    <div class="col-md-12">
        <h2>{{ $article->title }}</h2>
        <p>
            作者：{{ $article->user->nickname }}
            <span style="margin-left:20px">浏览：{{ $article->view }}</span>
            <span style="margin-left:20px">评论：{{ $article->comment }}</span>
            <span style="margin-left:20px">
                <a href="#"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                 {{ $article->comment }}
            </span>
        </p>
    </div>
</div>
