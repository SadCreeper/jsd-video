<div class="row">
    <div class="col-md-12">
        <h2>{{ $article->title }}</h2>
        <p>
            作者：{{ $article->user->nickname }}
            <span style="margin-left:20px">浏览：{{ $article->view }}</span>
            <span style="margin-left:20px">评论：{{ $article->comment }}</span>
            <span style="margin-left:20px">
                <a class="btn btn-default" id="praiseBtn" href="javascript:0">
                    <span class="glyphicon glyphicon-thumbs-up"></span>
                    <span id="praiseText">
                        @if(Auth::check())
                            @if($article->isPraise($article->id))
                             取消赞
                            @else
                             点赞
                            @endif
                        @else
                            点赞
                        @endif
                    </span>
                    (<span id="praiseNum">{{ sizeof($article->users_praise) }}</span>)
                </a>
            </span>
        </p>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">

    $("a#praiseBtn").click(function(){
        result = $.ajax({
            url:"/articles/praise/{{ $article->id }}",
            type:"GET",
            success:function($mes){
                //成功 进一步判断
                if ($mes.status == 10001) {
                    //取消成功
                    console.log($mes)
                    //更新数字
                    var praiseNum = parseInt($("#praiseNum").text());
                    praiseNum --;
                    $("#praiseNum").text(praiseNum)
                    //更新按钮内容
                    $("#praiseText").text(" 点赞")
                }else if ($mes.status == 200) {
                    //点赞成功
                    console.log($mes)
                    //更新数字
                    var praiseNum = parseInt($("#praiseNum").text());
                    praiseNum ++;
                    $("#praiseNum").text(praiseNum)
                    //更新按钮内容
                    $("#praiseText").text(" 取消赞")
                }else if ($mes.status == 10002) {
                    alert('请先登录')
                }
            },
            error:function($err){
                alert('服务器错误')
                console.log($err)
            },
        });
    })
    </script>
@endsection
