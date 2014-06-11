<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Location extends Eloquent implements SluggableInterface{

    use SluggableTrait;

    protected $guarded = array();

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    public function fullAddress($nl2br = true){
      $address = $this->address . "\n" . $this->city . ', ' . $this->state . ' ' . $this->zip_code;
      if($nl2br):
         $address = nl2br($address);
      endif;
      return $address;
    }

    public function googleMapsEmbedString(){
      return urlencode($this->fullAddress(false));
    }

}