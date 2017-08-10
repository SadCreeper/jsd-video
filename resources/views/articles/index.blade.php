@extends('users.user_app')

@section('title', '我的上传')

@section('nickname', Auth::user()->nickname)

@section('motto', Auth::user()->motto)

@section('user_content')
    @include('shared.errors')
    @include('shared.messages')
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="success">
                <th>ID</th>
                <th>类型</th>
                <th>标题</th>
                <th>分类</th>
                <th>封面图片</th>
                <th>浏览量</th>
                <th>评论量</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>@if($article->type == 1) 视频 @elseif($article->type == 2) 相册 @endif</td>
                        <td><a href="{{ route('articles.edit', $article->id) }}">{{ $article->title }}</a></td>
                        <td>{{ $article->category->name }}</td>
                        <td><img src="{{ $article->cover }}" alt="" style="width:50px"></td>
                        <td>{{ $article->view }}</td>
                        <td>{{ $article->comment }}</td>
                        <td>{{ $article->created_at }}</td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#deleteArticle{{ $article->id }}"><span class="glyphicon glyphicon-minus-sign" style="color:#F08080"></span></a>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteArticle{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                                  <div class="modal-content" style="text-align:center">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" id="myModalLabel">确认删除该上传吗？</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="post" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
@endsection
