@extends('layouts.master')

@section('content')

   <ul>
      @foreach($users as $user)
         <li><a href="{{ route('community.user', array('id' => $user->id)) }}"><img src="{{ $user->avatar(40) }}" class="avatar" />{{ $user->name }}</a></li>
      @endforeach
   </ul>

@stop