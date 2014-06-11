@extends('layouts.master')

@section('content')

   {{ Form::model($event, array('route' => array('classes.update', $event->topic->slug, $event->id))) }}

      @include('class.form')

   {{ Form::close() }}

@stop