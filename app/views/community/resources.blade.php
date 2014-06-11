@extends('layouts.master')

<?php

   $topics = Topic::all();
   $venues = Location::all();

?>

@section('content')
   <h2>Resources</h2>

   <h4>Venues:</h4>
   <ul>
      @foreach($venues as $venue)
         <li>{{ $venue->title }}</li>
      @endforeach
   </ul>

   <h4>Topics to Teach:</h4>
   <ul>
      @foreach($topics as $topic)
         <li>{{ $topic->title }}</li>
      @endforeach
   </ul>

@stop