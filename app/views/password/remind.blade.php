@extends('layouts.master')

@section('content')
   {{ Form::open(array('route' => 'password.reset.post')) }}
       <div class="form-group">
         {{ Form::label('email', 'Email Address') }}
         {{ Form::email('email', $email, array('class' => 'form-control')) }}
      </div>
      {{ Form::submit('Send Reminder', array('class' => 'btn btn-default')) }}
   {{ Form::close() }}
@stop