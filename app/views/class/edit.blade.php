   {{ Form::model($event, array('route' => 'classes.update', 'id' => $event->id)) }}

      {{ Form::label('start', 'Start Time') }}
      {{ Form::text('start') }}

      {{ Form::label('end', 'End Time') }}
      {{ Form::text('end') }}

      {{ Form::label('location', 'Location') }}
      {{ Form::select('location') }}

   {{ Form::close() }}