<?php

class ClassController extends BaseController {

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

      if(Input::get('unrsvp')):
         $event->attendees()->detach($user);
         Alert::info('OK you are no longer attending this class. No biggie if you change your mind, just click Join This Class!')->flash();
      else:
         if($event->attendees->contains($user->id)):
            Alert::warning('You\'re already attending that class, you big silly goof!')->flash();
         else:
            $event->attendees()->attach($user);
            Alert::success('Sweet! You\'ve been added. Look out for a calendar invite in your inbox, see you then!')->flash();
         endif;
      endif;

      // send email.
      // Mail::pretend();
      $vCalendar = $event->getVCalendar();
      $user = Auth::user();

      $data = array('event' => $event, 'user' => Auth::user(), 'vCalendar' => $vCalendar);

      Mail::send('emails.classes.invite', $data, function($message) use ($user, $event, $vCalendar)
      {
          $message->from('jon.c.culver@gmail.com', 'Jon Culver');
          $message->to('jon.c.culver@gmail.com', 'Jon Culver');
          $message->attachData($vCalendar->render(), 'invite.ics', array('mime' => 'text/calendar'));
          $message->addPart($vCalendar->render(), 'text/calendar');
      });

      return Redirect::to($event->permalink());
   }

}
