   {{ Form::model($event, array('route' => 'classes.create.post')) }}

      <h4>Class Information</h4>

      @if(isset($topics))
         <div class="form-group">
            {{ Form::label('topic_id', 'Topic') }}
            {{ Form::select('topic_id', $topics, null, array('class' => 'form-control')) }}
            <p class="help-block">Select an existing topic, or you can <a href="#topicForm" class="slideDown">create a new one</a>.</p>
         </div>
      @endif

      <div class="row" id="topicForm" @if(isset($topics))style="display: none;"@endif>

         @include('topic.form')

      </div>

      <hr />

      <h4>Location</h4>

      @if(isset($venues))
         <div class="form-group">
            {{ Form::label('location_id', 'Venue') }}
            {{ Form::select('location_id', $venues, null, array('class' => 'form-control')) }}
            <p class="help-block">Select an existing venue, or you can <a href="#locationForm" class="slideDown">create a new one</a>.</p>
         </div>
      @endif

      <div class="row" id="locationForm" @if(isset($venues))style="display: none;"@endif>

         @include('location.form')

      </div>

      <hr />

      <h4>Date &amp; Time</h4>
      <div class="row">
         <div class="col-md-3 form-group">
            {{ Form::label('date', 'Date') }}
            {{ Form::input('date', 'date', isset($next_week) ? $next_week->format('Y-m-d') : $event->start->format('Y-m-d'), array('class' => 'form-control')) }}
         </div>

         <div class="col-md-3 form-group">
            {{ Form::label('start', 'Start Time') }}
            {{ Form::input('time', 'start', '18:00', array('class' => 'form-control')) }}
         </div>

         <div class="col-md-3 form-group">
            {{ Form::label('end', 'End Time') }}
            {{ Form::input('time', 'end', '20:00', array('class' => 'form-control')) }}
         </div>
      </div>

      <hr />

      <h4>Extra</h4>
      <div class="form-group">
         {{ Form::label('max_cap', 'Max Capacity') }}
         {{ Form::text('max_cap', null, array('class' => 'form-control')) }}
         <p class="help-block">Optional; blank means no limit</p>
      </div>

      {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

      @if($event->id)
         <a href="{{ $event->permalink() }}" class="btn btn-default btn-secondary">Discard Changes</a>
      @endif

   {{ Form::close() }}