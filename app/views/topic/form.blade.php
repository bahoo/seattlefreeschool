<div class="col-md-6 col-lg-6">

   {{ Form::hidden('topic[save]', 0, array('id' => 'saveTopic')) }}

   <div class="form-group">
      {{ Form::label('topic[title]', 'Title') }}
      {{ Form::text('topic[title]', $event->title, array('class' => 'form-control')) }}
   </div>

   <div class="form-group">
      {{ Form::label('topic[summary]', 'Summary') }}
      {{ Form::text('topic[summary]', $event->summary, array('class' => 'form-control')) }}
      <p class="help-block">Short taglines work best here.</p>
   </div>

   @if(!$event->id)

      <div class="form-group">
         {{ Form::button('Cancel', array('class' => 'btn btn-secondary cancel-save', 'data-toggle' => 'saveTopic')) }}
      </div>

   @endif

</div>

<div class="col-md-6 col-lg-6 form-group">
   {{ Form::label('topic[description]', 'Description') }}
   {{ Form::textarea('topic[description]', $event->description, array('class' => 'form-control', 'rows' => 5)) }}
   <p class="help-block">todo: recommendations</p>
</div>