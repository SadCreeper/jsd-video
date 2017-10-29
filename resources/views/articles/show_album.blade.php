@extends('layouts.app_imax')

@section('title', $article->title)

@section('styles')
<!-- 评论 -->
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">
<link href="{{ asset('/vendor/laravelLikeComment/css/style.css') }}" rel="stylesheet">
@endsection

@section('content_under')
<div class="container">

    @include('articles._show_info')

    <div class="row masonry">
        @for($i = 0; $i < sizeof($photos_arr); $i++)
        <div class="col-md-3 item" style="margin-bottom:20px">
            <a href="#" onclick="return false" data-toggle="modal" data-target="#myModal" data-whatever="{{ $photos_arr[$i] }}"><img src="http://z970-video.oss-cn-shanghai.aliyuncs.com/{{ $photos_arr[$i] }}" alt="" style="width:100%"></a>
        </div>
        @endfor
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">图片查看</h4>
      </div>
      <div class="modal-body">
          <img src="" alt="" class="img-responsive">
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!--瀑布流-->
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
<script>
$('.masonry').imagesLoaded(function() {
    $('.masonry').masonry({
    itemSelector: '.item'
    });
});
</script>

<!-- 图片查看器 -->
<script type="text/javascript">
$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var url = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  console.log(url)
  modal.find('.modal-body img').attr("src", "http://z970-video.oss-cn-shanghai.aliyuncs.com/" + url)

})
</script>

<!-- 评论 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>
@endsection
