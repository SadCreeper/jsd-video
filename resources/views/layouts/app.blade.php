{{-- 这是公共视图模板：包含了导航栏、底部信息栏 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '无标题') - 浊酒·清心 弘扬中国文化，传承民族精神</title>

    <!-- icon -->
    <link rel="shortcut icon" href="/img/favicon.ico" />
    <link rel="bookmark" href="/img/favicon.ico" type="image/x-icon"　/>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    @yield('styles')
</head>
<body id="app"> <!-- id = app : 开启 Vue.js-->

    @include('layouts._header')

    @include('shared.errors')
    @include('shared.messages')
    @yield('content')

    @include('layouts._footer')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
    $(document).ready(function(){
        //注册响应
        $("button#signUpBtn").click(function(){
            var form_data = $("form#signUpForm").serialize()
            result = $.ajax({
                url:"{{ route('users.store') }}",
                type:"POST",
                data:form_data,
                success:function($mes){
                    //成功 打印返回信息并重定向到首页
                    //console.log($mes)
                    $("#signUpInfo").show()
                    $("#signUpInfo").html($mes.message)
                    emptyForm("#signUpForm")
                    window.location.href="/"
                },
                error:function($err){
                    //失败 打印返回信息
                    $err = JSON.parse($err.responseText)
                    var signUpWarn = "";
                    for (var i in $err) {
                        signUpWarn += "<li>"+$err[i]+"</li>"
                    }
                    $("#signUpWarn").show()
                    $("#signUpWarn").html(signUpWarn)
                },
            });
        })
        //清空表单
        function  emptyForm(formId){
            $(':input',formId)
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
        }
    });
    </script>
    @yield('script')
</body>
</html>
