@extends('layouts.master')

@section('content')

  <div class="sidebar">
    @if($is_facilitating)
      @include('class.attend-facilitator')
    @elseif(!$event->isPast())
      @include('class.attend-mini')
    @endif
  </div>

  <h1>{{ $event->topic->title }}</h1>
  <p class="host-and-attendees">Led by {{ $event->facilitatorsInline() }} &bull; {{ $event->attendees->count() }} attendees</p>
  {{ $event->topic->description }}

  <p><b>@if($event->isPast())This class took place @endif {{ $event->dateDescriptive() }}</b></p>

  <h4>{{ $event->location->title }}</h4>
  <p>{{ $event->location->fullAddress() }}</p>

  <section class="row">
    <iframe class="flex-video" width="700" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ $event->location->googleMapsEmbedString() }}&amp;output=embed"></iframe>
  </section>

  @if($event->facilitators)

    <h4>About Our Facilitators</h4>

    <div class="list-group">
      @foreach($event->facilitators as $facilitator)
        <a href="{{ $facilitator->name }}" class="list-group-item media">
          <div class="pull-left">
            <img src="{{ $facilitator->avatar() }}" class="media-object avatar" />
          </div>
          <div class="media-body">
            <h4 class="list-group-item-heading media-heading">{{ $facilitator->name }}</h4>
            <p class="list-group-item-text">{{ $facilitator->bio }}</p>
          </div>
        </a>
      @endforeach
    </div>

  @endif


@stop
