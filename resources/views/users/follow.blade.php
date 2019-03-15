@if($follow)
<form action="{{route('users.follow',$user->id)}}" method="post">
	{{csrf_field()}}
<button class="layui-btn layui-btn-normal follow">关注</button>
</form>
@else
<form action="{{route('users.unfollow',$user->id)}}" method="post">
	{{csrf_field()}}
	{{method_field('DELETE')}}
<button class="layui-btn layui-btn-danger" style="margin-left: 46.5%;">取消关注</button>
</form>
@endif
