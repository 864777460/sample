<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Sample App') - Laravel 入门教程</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('layui/css/layui.css')}}">
    <script type="text/javascript" src="{{URL::asset('layui/layui.js')}}"></script>

  </head>
  <body>
    @include('layouts._header')

    <div style="width: 100%;float: left;">
      <div class="col-md-offset-1 col-md-10">
        @include('shared._message')
        @yield('content')
        @include('layouts._footer')
      </div>
    </div>
  <script src="/js/app.js"></script>
  </body>
</html>