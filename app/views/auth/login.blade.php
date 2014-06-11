@extends('layouts.master')

@section('content')
   {{ Form::open(array('route' => 'login.post')) }}

      <div class="form-group">
         {{ Form::label('email', 'Email Address') }}
         {{ Form::email('email', Input::get('email'), array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
         {{ Form::label('password', 'Password') }} (<a href="/password/remind">Forgot?</a>)
         {{ Form::password('password', array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Login', array('name' => 'login', 'class' => 'btn btn-default')) }}

   {{ Form::close() }}
@stop