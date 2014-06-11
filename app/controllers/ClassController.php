<?php

use Carbon\Carbon;

class ClassController extends BaseController {

   public function getCreate($slug = false){

      if(Authority::cannot('create', 'ClassEvent')){
         Alert::danger('You don not have permission to create a new class.')->flash();
         return Redirect::route('classes.index');
      }

      $topics = Topic::all()->lists('title', 'id');
      $venues = Location::all()->lists('title', 'id');
      $next_week = Carbon::now()->addWeek();
      $event = new ClassEvent();
      return View::make('class.create', array('topics' => $topics,
                                                'venues' => $venues,
                                                'next_week' => $next_week,
                                                'event' => $event));
   }

   public function postCreate(){

      if(Authority::cannot('create', 'ClassEvent')){
         Alert::danger('You don not have permission to create a new class.')->flash();
         return Redirect::route('classes.index');
      }

      $event = new ClassEvent();

      // save topic, if needed.
      $topic_fields = Input::get('topic');
      if($topic_fields['save']):
         unset($topic_fields['save']);
         $topic = new Topic($topic_fields);
         $topic->save();
         $event->topic_id = $topic->id;
         $event->fill($topic_fields);
      else:
         $topic = Topic::find(Input::get('topic_id'));
         $topic_fields = $topic->attributesToArray();
         unset($topic_fields['slug']);
         unset($topic_fields['id']);
         $event->fill($topic_fields);
         $event->topic_id = $topic->id;
      endif;

      // save location, if needed.
      $location_fields = Input::get('location');
      if($location_fields['save']):
         unset($location_fields['save']);
         $location = new Location($location_fields);
         $location->save();
         $event->location_id = $location->id;
      else:
         $location = Location::find(Input::get('location_id'));
         $event->location_id = $location->id;
      endif;

      $fields = Input::only('max_cap');
      $fields['start'] = Input::get('date') . ' ' . Input::get('start');
      $fields['end'] = Input::get('date') . ' ' . Input::get('end');
      $event->fill($fields);

      $user = Auth::user();
      $event->save();
      $event->users()->save($user, array('type' => 'facilitator'));

      return Redirect::to($event->permalink());

   }

   public function edit($slug, $id){

      $event = ClassEvent::find($id);

      if(Authority::cannot('manage', $event)){
         Alert::danger('You don not have permission to edit a class.')->flash();
         return Redirect::route('classes.index');
      }

      $venues = Location::all()->lists('title', 'id');
      $event->start = new Carbon($event->start);
      return View::make('class.edit', array('event' => $event, 'venues' => $venues));
   }

   public function update($slug, $id){

      $event = ClassEvent::find($id);

      if(Authority::cannot('manage', $event)){
         Alert::danger('You don not have permission to edit a class.')->flash();
         return Redirect::route('classes.index');
      }

      $topic_fields = Input::get('topic');
      unset($topic_fields['save']);
      $event->fill($topic_fields);

      $event->start = Input::get('date') . ' ' . Input::get('start');
      $event->end = Input::get('date') . ' ' . Input::get('end');

      // save location, if needed.
      $location_fields = Input::get('location');
      if($location_fields['save']):
         unset($location_fields['save']);
         $location = new Location($location_fields);
         $location->save();
         $event->location_id = $location->id;
      else:
         $location = Location::find(Input::get('location_id'));
         $event->location_id = $location->id;
      endif;

      $event->max_cap = Input::get('max_cap');

      $event->save();

      return Redirect::to($event->permalink());


   }

   public function index($slug = false){

      $events = ClassEvent::with('topic', 'location');

      $is_events_filtered = $filtered_topic = false;

      if($slug):
         $topic = Topic::where('slug', $slug)->firstOrFail();
         $filtered_events = $events->where('topic_id', $topic->id);
         if($filtered_events->count() > 0):
            $events = $filtered_events;
            $is_events_filtered = true;
            $filtered_topic = $topic->title;
         endif;
      endif;

      return View::make('class.attend',
                  array('is_events_filtered' => $is_events_filtered,
                  'filtered_topic' => $filtered_topic,
                  'events' => $events->get()));
   }

   public function view($slug, $id){

      # todo: validate slug / ID combo.
      $event = ClassEvent::find($id);
      $is_facilitating = Auth::check() && $event->facilitators->contains(Auth::user()->id);
      $is_attending = Auth::check() && $event->attendees->contains(Auth::user()->id);

      $form_route = Auth::check() ? array('classes.attend', array('id' => $event->id)) : 'login';

      return View::make('class.view', array('event' => $event,
                                       'is_attending' => $is_attending,
                                       'is_facilitating' => $is_facilitating,
                                       'form_route' => $form_route));
   }

   public function host(){
      $topics = Topic::lists('title');
      return View::make('class.host', array('topics' => $topics));
   }

   public function attend($slug, $id){

      $event = ClassEvent::find($id);
      $user = Auth::user();

      if(Authority::cannot('attend', $event)):
         if($event->facilitators->contains($user->id)):
            Alert::warning('You are hosting the class, you big silly goof!')->flash();
            return Redirect::to($event->permalink());
         else:
            Alert::warning('You must be logged in to attend a class. Create a free account now!');
            return Redirect::to($event->permalink());
         endif;
      endif;

      if(Input::get('unrsvp')):
         $event->attendees()->detach($user);
         Alert::info('OK you are no longer attending this class. No biggie if you change your mind, just click Join This Class!')->flash();
      else:
         $event->attendees()->attach($user);
         Alert::success('Sweet! You\'ve been added. Look out for a calendar invite in your inbox, see you then!')->flash();
         // todo: send calendar invite.
      endif;

      return Redirect::to($event->permalink());
   }

}
