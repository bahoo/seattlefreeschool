<?php

return array(

    'initialize' => function($authority) {
      $user = $authority->getCurrentUser();

      // this may be overly naive but I think it will do.
      if(!$user){
         return;
      }

      $authority->addAlias('manage', array('create', 'read', 'update', 'delete'));
      $authority->addAlias('moderate', array('read', 'update', 'delete'));

      if($user->hasRole('admin')){
         $authority->allow('manage', 'all');
      }

      if($user->hasRole('facilitator')){
         $authority->allow('manage', 'ClassEvent', function($self, $class_event){
            $class_event->facilitators->contains($self->getCurrentUser()->id);
         });
      }

      // anyone logged in can attend a class
      // unless you are the facilitator
      $authority->allow('attend', 'ClassEvent', function($self, $class_event){
         !$class_event->facilitators->contains($self->getCurrentUser()->id);
      });

    }

);
