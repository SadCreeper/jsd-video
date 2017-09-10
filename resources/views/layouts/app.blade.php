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

    @yield('content')

    @include('layouts._footer')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
    $(document).ready(function(){
        //注册响应
        $("button#signUpBtn").click(function(){
            //提交表单
            var form_data = $("form#signUpForm").serialize()
            result = $.ajax({
                url:"{{ route('users.store') }}",
                type:"POST",
                data:form_data,
                success:function($mes){
                    //成功 进一步判断
                    if ($mes.status == 10001) {
                        //注册失败 - 验证码错误，打印错误信息
                        console.log($mes)
                        $("#signUpWarn").show()
                        $("#signUpWarn").html($mes.message)
                    }else if ($mes.status == 200) {
                        //注册成功 打印返回信息并重定向到首页
                        //console.log($mes)
                        $("#signUpWarn").hide()
                        $("#signUpInfo").show()
                        $("#signUpInfo").html($mes.message)
                        emptyForm("#signUpForm")
                        window.location.href="/"
                    }

                },
                error:function($err){
                    if ($err.status == 500) {
                        var categoryWarn = "服务器错误！"
                    }else {
                        //失败 打印返回信息
                        $err = JSON.parse($err.responseText)
                        var signUpWarn = "";
                        for (var i in $err) {
                            signUpWarn += "<li>"+$err[i]+"</li>"
                        }
                    }
                    $("#signUpWarn").show()
                    $("#signUpWarn").html(signUpWarn)
                },
            });
        })
        //登录响应
        $("button#signInBtn").click(function(){
            var form_data = $("form#signInForm").serialize()
            result = $.ajax({
                url:"{{ route('login') }}",
                type:"POST",
                data:form_data,
                success:function($mes){
                    //成功 进一步判断
                    if ($mes.status == 10001) {
                        //登录失败，打印错误信息
                        console.log($mes)
                        $("#signInWarn").show(300).delay(1000).hide(300)
                        $("#signInWarn").html($mes.message)
                    }else if ($mes.status == 200) {
                        //登陆成功
                        //console.log($mes)
                        $("#signInWarn").hide()
                        $("#signInInfo").show()
                        $("#signInInfo").html($mes.message)
                        emptyForm("#signUpForm")
                        window.location.href="/"
                    }
                },
                error:function($err){
                    //失败 打印返回信息
                    //console.log($err)
                    if ($err.status == 500) {
                        var categoryWarn = "服务器错误！"
                    }else {
                        $err = JSON.parse($err.responseText)
                        var signInWarn = "";
                        for (var i in $err) {
                            signInWarn += "<li>"+$err[i]+"</li>"
                        }
                    }
                    $("#signInWarn").show()
                    $("#signInWarn").html(signInWarn)
                },
            });
        })
        //退出登录
        $("a#signOutBtn").click(function(){
            $("form#signOutForm").submit()
        })
        //游客点击上传后处理
        $("#uploadBtn").click(function(){
            alert("请先登录！")
            $('#signIn').modal('show')
        })
        //发送验证码
        $("#verifyCodeBtn").click(function(z){
            //60s后再次发送
            var counter = $('#verifyCodeBtnWait')
            $(z.target).hide()
            counter.show()

            var text = "s 后再次发送"
            var number = 60
            counter.text(number + text)

            var t = setInterval(function() {
                number -= 1
                counter.text(number + text)
                if (number === 0) {
                    clearInterval(t)
                    $(z.target).show()
                    counter.hide()
                }
            }, 1000)

            //发送验证码
            var phone = $("input#phone").val();
            $.ajax({
                url:"/verify",
                type:"POST",
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'phone':phone
                },
                success:function($mes){
                    //成功 进一步判断
                    console.log($mes)
                    if ($mes.status == 10001) {
                        //发送失败，打印错误信息
                        console.log($mes)
                        $("#signUpWarn").show(300).delay(1000).hide(300)
                        $("#signUpWarn").html($mes.message)
                    }else if ($mes.status == 200) {
                        //发送成功，打印返回信息
                        //console.log($mes)
                        $("#signUpWarn").hide()
                        $("#signUpInfo").show(300).delay(1000).hide(300)
                        $("#signUpInfo").html($mes.message)
                    }

                },
                error:function($err){
                    //失败 打印返回信息
                    console.log($err)
                    if ($err.status == 500) {
                        var signUpWarn = "服务器错误！";
                    }else if ($err.status == 429) {
                        var signUpWarn = "请稍等再发送";
                    }else {
                        $err = JSON.parse($err.responseText)
                        var signUpWarn = "";
                        for (var i in $err) {
                            signUpWarn += "<li>"+$err[i]+"</li>"
                        }
                    }
                    $("#signUpWarn").show(300).delay(1000).hide(300)
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
    <!-- 提交反馈表单 -->
    <script type="text/javascript">
        $("button#feedbackBtn").click(function(){
            var feedback = $("#feedbackText").val()
            $.ajax({
                url:"/feedback",
                type:"POST",
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'feedback':feedback
                },
                success:function($mes){
                    //成功 进一步判断
                    console.log($mes);
                    if ($mes.status == 200) {
                        //发送成功
                        alert('发送成功，感谢您的反馈！')
                        $('#feedback').modal('hide')
                    }
                },
                error:function($err){
                    //失败 打印返回信息
                    console.log($err);
                },
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
