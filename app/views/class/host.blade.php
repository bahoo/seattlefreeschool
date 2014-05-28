@extends('layouts.master')

@section('content')

  <h3>How It Works</h3>
  <p>It's simple. <a data-toggle="modal" href="#hostModal">Submit a request</a> to
    host a class. Let us know what topics you're interested in teaching, if any.</p>

  <p>We'll review your request, and invite you to take a Facilitator's Class. This
    gives future hosts some ideas of what to expect at your class event, and
    suggestions for how to make your class a successful experience. <b>Everyone
    who hosts a class with Seattle Free School must take the Facilitator's Class.</b>
    See <a href="{{ route('classes.index', array('slug' => 'facilitator')) }}">the
    schedule of upcoming Facilitator's Classes</a> and make plans to attend one
    soon once you're ready to teach.</p>

  <p>Seattle Free School will help you schedule your event and coordinate the
    specifics.</p>

  <h3>Topics to teach:</h3>
  <ul>
    @foreach($topics as $topic)
      <li>{{ $topic }}</li>
    @endforeach
  </ul>

  <h3>Benefits to Being a SFS Facilitator:</h3>
  <ul>
    <li><b>Public speaking experience</b> Conquer everyone's biggest fear in
      a friendly, inviting environment.</li>
    <li><b>Give something back</b></li>
  </ul>

  <p>We need your voice and your expertise.</p>
@stop


@stop