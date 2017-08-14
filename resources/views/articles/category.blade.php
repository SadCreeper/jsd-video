@extends('layouts.app_imax')

@section('title', '列表')

@section('content_under')

<div class="container">
    <!-- 分类 -->
    <div class="" style="height:40px">
        <h3>{{ $category->name }}</h3>
    </div>
    <!-- 列表区 -->
    <div class="row">
        <!-- 左侧 -->
        <div class="col-md-9">
            <!-- 推荐 -->
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <img src="/img/default.jpg" alt="" style="width:100%">
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/img/default.jpg" alt="" style="width:100%">
                        </div>
                        <div class="col-md-6">
                            <img src="/img/default.jpg" alt="" style="width:100%">
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-6">
                            <img src="/img/default.jpg" alt="" style="width:100%">
                        </div>
                        <div class="col-md-6">
                            <img src="/img/default.jpg" alt="" style="width:100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <img src="/img/default.jpg" alt="" style="width:100%">
                </div>
                <div class="col-md-3">
                    <img src="/img/default.jpg" alt="" style="width:100%">
                </div>
                <div class="col-md-3">
                    <img src="/img/default.jpg" alt="" style="width:100%">
                </div>
                <div class="col-md-3">
                    <img src="/img/default.jpg" alt="" style="width:100%">
                </div>
            </div>
        </div>
        <!-- 右侧 -->
        <div class="col-md-3">
            <h4>热播排行</h4>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
            <p>1 过马路遇车主礼让 老人脱帽鞠躬</p>
        </div>
    </div>
</div>
@endsection
