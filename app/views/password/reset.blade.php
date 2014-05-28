@extends('layouts.master')

@section('content')
   {{ Form::open(array('route' => 'password.reset.post')) }}
      {{ Form::hidden('token', $token) }}
      <div class="form-group">
         {{ Form::label('email', 'Email Address') }}
         {{ Form::email('email', null, array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
         {{ Form::label('password', 'Password') }}
         {{ Form::password('password', array('class' => 'form-control')) }}
      </div>

      <div class="form-group">
         {{ Form::label('password_confirmation', 'Password Again')}}
         {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
      </div>

      {{ Form::submit('Reset Password', array('class' => 'form-control')) }}
   {{ Form::close() }}
@stop