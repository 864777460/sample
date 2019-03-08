<html>
  <head>
    <title>@yield('title', 'Weibo App') - Laravel 入门教程</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/header.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/footer.css')}}">
  </head>
  <body>

@include('layouts._header');

    <div class="container">
      @yield('content')
      @include('layouts._footer')
    </div>
  </body>
</html>