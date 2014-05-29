@if(Auth::check())
  {{ Form::open(array('route' => array('classes.attend', $event->topic->slug, $event->id))) }}
    @if($is_attending)
      {{ Form::hidden('unrsvp', 1) }}
      <h4>You're attending!</h4>
      <p>Need to update your RSVP?</p>
      {{ Form::submit('Leave This Class', array('class' => 'btn btn-default')) }}</p>
    @else
      {{ Form::hidden('attend_event_id', $event->id) }}
      <h4>Want to attend?</h4>
      <p>All of our classes are totally free and open to everyone!</p>
      {{ Form::submit('Join This Class', array('name' => 'signup', 'class' => 'btn btn-default')) }}
    @endif
  {{ Form::close() }}
@else
  {{ Form::open(array('route' => 'login'))}}
    {{ Form::hidden('attend_event_id', $event->id) }}
    <h4>Want to attend?</h4>
    <p>All of our classes are totally free and open to everyone!</p>
    <div class="form-group">
      {{ Form::label('email', 'Email Address') }}
      {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      {{ Form::label('password', 'Password') }}
      {{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Join This Class', array('name' => 'signup', 'class' => 'btn btn-default')) }}
  {{ Form::close() }}
@endif
