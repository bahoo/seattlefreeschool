<div class="col-md-6 col-lg-6">

   {{ Form::hidden('location[save]', 0, array('id' => 'saveLocation')) }}

   <div class="form-group">
      {{ Form::label('location[title]', 'Title') }}
      {{ Form::text('location[title]', null, array('class' => 'form-control')) }}
   </div>

   <div class="row">

      <div class="col-md-6 col-lg-6 form-group">
         {{ Form::label('location[address]', 'Address') }}
         {{ Form::text('location[address]', null, array('class' => 'form-control')) }}
      </div>

      <div class="col-md-6 col-lg-6 form-group">
         {{ Form::label('location[address2]', 'Address 2') }}
         {{ Form::text('location[address2]', null, array('class' => 'form-control')) }}
      </div>

   </div>

   <div class="row">

      <div class="col-md-4 col-lg-4 col-sm-5 col-xs-5 form-group">
         {{ Form::label('location[city]', 'City') }}
         {{ Form::text('location[city]', null, array('class' => 'form-control')) }}
      </div>

      <div class="col-md-4 col-lg-4 col-sm-5 col-xs-5 form-group">
         {{ Form::label('location[state]', 'State') }}
         {{ Form::text('location[state]', null, array('class' => 'form-control')) }}
      </div>

      <div class="col-md-4 col-lg-4 col-sm-2 col-xs-2 form-group">
         {{ Form::label('location[zip_code]', 'Zip') }}
         {{ Form::text('location[zip_code]', null, array('class' => 'form-control')) }}
      </div>


   </div>

   <div class="form-group">
      {{ Form::button('Cancel', array('class' => 'btn btn-secondary cancel-save', 'data-toggle' => 'saveLocation')) }}
   </div>

</div>

<div class="col-md-6 col-lg-6 form-group">
   <div class="row">
      <div class="col-lg-6 col-md-6 form-group">
         {{ Form::label('location[phone]', 'Phone') }}
         {{ Form::input('tel', 'location[phone]', null, array('class' => 'form-control')) }}
      </div>

      <div class="col-lg-6 col-md-6 form-group">
         {{ Form::label('location[url]', 'URL') }}
         {{ Form::input('url', 'location[url]', null, array('class' => 'form-control')) }}
      </div>
   </div>

   {{ Form::label('location[description]', 'Description') }}
   {{ Form::textarea('location[description]', null, array('class' => 'form-control', 'rows' => 5)) }}
   <p class="help-block">todo: recommendations</p>

</div>