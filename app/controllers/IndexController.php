<?php

class IndexController extends BaseController {

	public function index()
	{
      $class_count = ClassEvent::count();
		return View::make('index', array('class_count' => $class_count));
	}

}
