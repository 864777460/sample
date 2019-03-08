<html>
  <head>
    <title>@yield('title','Sample')</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/header.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.min.css')}}">
  </head>
  <body>
  <div class="header">
  	<div class="title">Weibo App</div>
  	<div class="login"><a href="">帮助</a><a href="" style="margin-left: 10%;">登录</a></div>
  </div>
  <div class="container">
    @yield('content')
    </div>
  </body>
</html>