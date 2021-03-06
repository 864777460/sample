@extends('layouts.default')
@section('title',$user->name)
@section('content')
<div class="row">
        <section class="user_info">
          @include('shared._user_info', ['user' => $user])
        </section>
        @can('follow',$user)
        <section>
          @include('users.follow',['user' => $user])
        </section>
        @endcan
         <section class="stats mt-2">
      @include('shared._stats', ['user' => $user])
    </section>
         <section class="status">
      @if ($statuses->count() > 0)
        <ul class="list-unstyled">
          @foreach ($statuses as $status)
            @include('statuses._status')
          @endforeach
        </ul>
        <div class="mt-5">
          {!! $statuses->render() !!}
        </div>
      @else
        <p>没有数据！</p>
      @endif
    </section>
</div>
{{$user->name}} - {{$user->email}}
{{$user->gravator}}
@stop