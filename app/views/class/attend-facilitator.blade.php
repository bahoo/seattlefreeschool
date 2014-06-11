<div class="admin-features">
   <h4>Facilitator Control Panel</h4>
   <p>Need to change the title, description, venue or time?</p>
   <a href="{{ route('classes.edit', array('slug' => $event->topic->slug, 'id' => $event->id)) }}" class="btn btn-primary">Edit Class Details</a>

   <hr />

   <h4>Attendees ({{ $event->attendees->count() }})</h4>
   @if($event->attendees->count() > 0)

      <ol>
         @foreach($event->attendees as $attendee)
            <li><a href="{{ $attendee->permalink(); }}">{{ $attendee->name }}</a> - <a href="mailto:{{ $attendee->email }}">{{ $attendee->email }}</a></li>
         @endforeach
      </ol>

      <a href="mailto:{{ Auth::user()->email }}?subject=[SFS] {{ $event->topic->title }}&amp;bcc={{ $event->attendees->implode('email') }}" class="btn btn-default">Email All Attendees</a>
      <p><small>Be careful and mindful of your attendees though! Spammy activity will get your email privileges revoked.</small></p>
   @endif
</div>