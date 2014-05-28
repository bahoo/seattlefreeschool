<?php

Event::listen('auth.login', function($user)
{
   Log::info(Session::get('attend_event_id'));
   if($event_id = Session::get('attend_event_id')):
      Log::info('dont freak out');
      $event = Event::find($event_id);
      $event->users()->save(Auth::user());
      Session::forget('attend_event_id');
   endif;
});