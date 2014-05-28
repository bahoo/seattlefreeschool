@extends('layouts.master')

@section('content')
	<h2>Seattle Free School is local community devoted to sharing knowledge.
	  All free, all the time.</h2>

	<ul>
	  <li>We have {{ $class_count or 0 }} classes coming up. <a href="{{ route('classes.index') }} ">Attend a class</a> and learn a new skill!</li>
	  <li>Everyone's an expert on something. <a href="{{ route('classes.host') }}">Host a class!</a></li>
	  <li>Get involved with the <a href="{{ route('community') }}">Seattle Free School community</a></li>
	</ul>

@stop
