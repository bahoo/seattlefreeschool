<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Topic extends Eloquent implements SluggableInterface{

    use SluggableTrait;

    protected $guarded = array();

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    // public function events(){
    //   $this->hasMany('ClassEvent');
    // }

}