@extends('layouts.app_imax')

@section('title', '首页')

@section('styles')
<style media="screen">
    @media screen and (max-width: 768px) {
        .z-padding-phone{
            padding-left: 7px;
            padding-right: 7px;
        }
        .z-img-bottom-bar{
            height:0;
            position:relative;
            top:-22px;
            color:white;
            background-color: black;
            filter:alpha(opacity=60);-moz-opacity:0.6;-khtml-opacity: 0.6;opacity: 0.6;
            white-space: nowrap;
            margin-bottom: 0
        }
    }
</style>
@endsection

@section('content_under')

<div class="container">
    <!-- 分类 TODO -->
    <div class="" style="height:50px">

    </div>

    <!-- 推荐区 -->
    <div class="row" style="margin-bottom:20px">
        <div class="col-md-5 z-padding-phone" style="margin-bottom:20px">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                  @foreach($articles_top as $article)
                    @if($loop->iteration == 1)
                        <div class="item active">
                          <a href="{{ route('articles.show', $article->id) }}"><img src="{{ $article->cover }}"></a>
                          <div class="carousel-caption">
                            {{ $article->title }}
                          </div>
                        </div>
                    @elseif($loop->iteration >= 2 && $loop->iteration <=3)
                        <div class="item">
                          <a href="{{ route('articles.show', $article->id) }}"><img src="{{ $article->cover }}"></a>
                          <div class="carousel-caption">
                            {{ $article->title }}
                          </div>
                        </div>
                    @endif
                  @endforeach
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
        <div class="col-md-7">
            <div class="row">
                @foreach($articles_top as $article)
                  @if($loop->iteration >= 4 && $loop->iteration <= 9)
                      @include('articles._cover')
                  @endif
                @endforeach
            </div>
        </div>
    </div>


    <!-- 热评区 -->
    <div class="row">
        <div class="col-md-12 z-padding-phone">
            <h4>热评区</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 z-padding-phone" style="margin-bottom:20px">
            @foreach($articles_hot as $article)
              @if($loop->iteration == 1)
                  <a href="{{ route('articles.show', $article->id) }}"><img src="{{ $article->cover }}" alt="" style="width:100%"></a>
              @endif
            @endforeach
        </div>
        <div class="col-md-7">
            <div class="row">
                @foreach($articles_hot as $article)
                  @if($loop->iteration >= 2 && $loop->iteration <= 7)
                      @include('articles._cover')
                  @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px;margin-bottom:20px">
        <div class="col-md-12 z-padding-phone">
            <img src="/img/banner.jpg" alt="" style="width:100%">
        </div>
    </div>

    <!-- 分类区 -->
    @for ($i = 0; $i < sizeof($articles_category); $i++)
        <div class="row">
            <div class="col-md-12 z-padding-phone">
                <h4>
                    {{ $articles_category[$i]['category_name'] }}
                    <a href="{{ route('articles.category', $articles_category[$i]['category_id']) }}"><span style="float:right">更多>></span></a>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 z-padding-phone" style="margin-bottom:20px">
                @foreach($articles_category[$i]['data'] as $article)
                  @if($loop->iteration == 1)
                      <a href="{{ route('articles.show', $article->id) }}"><img src="{{ $article->cover }}" alt="" style="width:100%"></a>
                  @endif
                @endforeach

            </div>
            <div class="col-md-7">
                <div class="row">
                    @foreach($articles_category[$i]['data'] as $article)
                      @if($loop->iteration >= 2 && $loop->iteration <= 7)
                          @include('articles._cover')
                      @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endfor
</div>



@endsection
