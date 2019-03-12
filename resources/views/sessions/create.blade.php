@extends('layouts.default')
@section('title','登录')
@section('content')
<section class="login">
 <div class="header">
 	<h3>登录</h3>
 </div>

 <div class="main">
 	@include('shared._errors')
 	 <form method="POST" action="{{route('login')}}">
 	{{csrf_field()}}
 	<div class="layui-form-item">
 		<label class="layui-form-label">邮箱:</label>
 		<div class="layui-input-block">
 			<input type="text" name="email" class="layui-input" value="{{old('email')}}">
 		</div>
 	</div>

 	<div class="layui-form-item">
 		<label class="layui-form-label">密码</label>
 		<div class="layui-input-block">
 			<input type="password" name="password" class="layui-input">
 		</div>
 	</div>
   <div class="checkbox" style="margin-left: 50px;">
   	<label><input type="checkbox" name="remember">记住我</label>
   </div>
 	<input type="submit" class="layui-btn layui-btn-normal" value="提交">
 	 </form>
 	 <div class="underline"></div> 

 	 <div class="footer">还没账号？<a href="{{route('signup')}}">马上注册</a></div>
 </div>


</section>
@stop