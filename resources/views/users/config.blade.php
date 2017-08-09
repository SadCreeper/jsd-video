@extends('users.user_app')

@section('title', '网站设置')

@section('nickname', Auth::user()->nickname)

@section('motto', Auth::user()->motto)

@section('user_content')
    <h3>分类管理</h3>

    <div id="categoryWarn" class="alert alert-danger" style="display:none">
        <!-- 分类管理警告信息 -->
    </div>
    <div id="categoryInfo" class="alert alert-info" style="display:none">
        <!-- 分类管理提示信息 -->
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr class="success">
                <th>排序</th>
                <th>分类名称</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td><input type="text" name="order" data-id="{{ $category->id }}" value="{{ $category->order }}"></td>
                <td><input type="text" name="name" data-id="{{ $category->id }}" value="{{ $category->name }}"></td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#deleteCategory{{ $category->id }}"><span class="glyphicon glyphicon-minus-sign" style="color:#F08080"></span></a>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-sm" role="document">
                          <div class="modal-content" style="text-align:center">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">确认删除该分类吗？</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: inline-block;">
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
    <form class="" action="{{ route('categories.store') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="name" value="未命名">
        <button type="submit" class="btn btn-primary">新增分类</button>
    </form>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    //更新分类信息 - 排序
    $("[name='order']").change(function(){
        console.log($(this).attr('data-id'))
        console.log($(this).val())
        var categoryId = $(this).attr('data-id')
        var categoryOrder = $(this).val()
        updateCategory(categoryId, "order", categoryOrder)
    });
    //更新分类信息 - 分类名
    $("[name='name']").change(function(){
        console.log($(this).attr('data-id'))
        console.log($(this).val())
        var categoryId = $(this).attr('data-id')
        var categoryName = $(this).val()
        updateCategory(categoryId, "name", categoryName)
    });
    //更新分类
    //@ categoryId  要更新的分类 id
    //@ key         要更新的字段名
    //@ value       要更新的内容
    function updateCategory(categoryId, key, value){
        var data={}
        data[key] = value
        $.ajax({
            url:"/categories/" + categoryId,
            type:"PATCH",
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            data:data,
            success:function($mes){
                console.log($mes)
                //成功
                //console.log($mes)
                $("#categoryWarn").hide()
                $("#categoryInfo").html($mes.message)
                $("#categoryInfo").show(300).delay(1000).hide(300)
            },
            error:function($err){
                //失败 打印返回信息
                if ($err.status == 500) {
                    var categoryWarn = "服务器错误！"
                }else{
                    $err = JSON.parse($err.responseText)
                    var categoryWarn = "";
                    for (var i in $err) {
                        categoryWarn += "<li>"+$err[i]+"</li>"
                    }
                }
                $("#categoryWarn").html(categoryWarn)
                $("#categoryWarn").show(300)
            },
        });
    }
});
</script>
@endsection
