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
<body>

    @include('layouts._header')

    <div class="container" id="app"> <!-- id = app : 开启 Vue.js-->
        @include('shared.errors')
        @include('shared.messages')
        @yield('content')
    </div>

    @include('layouts._footer')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @yield('script')
</body>
</html>
