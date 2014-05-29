<?php

use Carbon\Carbon;

class ClassEvent extends Eloquent{

   protected $table = 'events';

   # relationships

   public function attendees(){
      return $this->users()->where('type', 'attendee');
   }

   public function facilitators(){
      return $this->users()->wherePivot('type','facilitator');
   }

   public function users()
   {
      return $this->belongsToMany('user', 'event_users', 'event_id', 'user_id');
   }

   public function topic()
   {
      return $this->belongsTo('Topic');
   }

   public function location()
   {
      return $this->belongsTo('Location');
   }

   # conventions

   public function permalink()
   {
      return Route('classes.view', array('slug' => $this->topic->slug, 'id' => $this->id));
   }

   # conveniences

   public function isPast()
   {
      return $this->start < Carbon::now();
   }

   public function facilitatorsInline()
   {
      $facilitators = $this->facilitators()->lists('name');
      return implode(', ', $facilitators);
   }

   public function dateDescriptive()
   {

      $today = Carbon::today();

      if($this->start)
         $start = Carbon::createFromFormat('Y-m-d H:i:s', $this->start);

      if($this->end)
         $end = Carbon::createFromFormat('Y-m-d H:i:s', $this->end);

      $join = ($end) ? ' ' : ' at ';

      if($start->isFuture()):
         $text = $start->format('F jS, Y') . $join . $start->format('g:iA');
         if($end):
            $text .= ' - ' . $end->format('g:iA');
         endif;

      else:
         if($start->isToday()):
            $text = ($start->hour < 20 ? 'Today' : 'Tonight') . $join . $start->format('g:iA');
         elseif($start->addDays(7) > $today):
            $text = $start->format('l') . $join . $start->format('g:iA');
         else:
            $text = $start->format('F jS') . $join . $start->format('g:iA');
         endif;

         if($end):
            $text .= $end->format('g:iA');
         endif;

      endif;

      return $text;

   }

   public function getVCalendar()
   {
      $vCalendar = new \Eluceo\iCal\Component\Calendar('www.seattlefreeschool.org');
      $vEvent = new \Eluceo\iCal\Component\Event();
      $vEvent->setDtStart(new \DateTime('2014-05-31 12:00:00 PM'))
               ->setDtEnd(new \DateTime('2014-05-31 1:00:00 PM'))
               ->setSummary($this->topic->title)
               ->setAttendee('jon.c.culver@gmail.com')
               ->setOrganizer('seattlefreeschool@gmail.com');
      $vCalendar->addEvent($vEvent);

      // might need these.
      // header('Content-Type: text/calendar; charset=utf-8');
      // header('Content-Disposition: attachment; filename="cal.ics"');
      // echo $vCalendar->render();

      return $vCalendar;
   }

}