@extends('layouts.app')

@section('title', '首页')

@section('content')

<!-- 分类 TODO -->
<div class="" style="height:50px">

</div>

<!-- 推荐区 -->
<div class="row" style="margin-bottom:20px">
    <div class="col-md-5">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="/img/default.jpg" alt="...">
              <div class="carousel-caption">
                ...
              </div>
            </div>
            <div class="item">
              <img src="/img/default.jpg" alt="...">
              <div class="carousel-caption">
                ...
              </div>
            </div>
            <div class="item">
              <img src="/img/default.jpg" alt="...">
              <div class="carousel-caption">
                ...
              </div>
            </div>
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
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
        </div>
        <div class="row" style="margin-top:40px">
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
        </div>
    </div>
</div>


<!-- 热评区 -->
<div>
    <h4>热评</h4>
</div>
<div class="row">
    <div class="col-md-5">
        <img src="/img/default.jpg" alt="" style="width:100%">
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
        </div>
        <div class="row" style="margin-top:40px">
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
        </div>
    </div>
</div>
<div class="" style="margin-top:20px">
    <img src="/img/banner.jpg" alt="" style="width:100%">
</div>

<!-- 分类区 -->
<div>
    <h4>热评</h4>
</div>
<div class="row">
    <div class="col-md-5">
        <img src="/img/default.jpg" alt="" style="width:100%">
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
        </div>
        <div class="row" style="margin-top:40px">
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
            <div class="col-md-4">
                <img src="/img/default.jpg" alt="" style="width:100%">
            </div>
        </div>
    </div>
</div>

@endsection
