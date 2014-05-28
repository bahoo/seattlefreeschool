@extends('layouts.master')

@section('content')
   <img src="{{ $user->avatar(100) }}" class="avatar" />
   <h2>{{ $user->name }}</h2>
   @if($user->bio)
      <h4>{{ $user->bio }}</h4>
   @endif
   @if($user->link)
      <p><a href="{{ $user->link }}" rel="nofollow">{{ $user->link }}</a></p>
   @endif
@stop