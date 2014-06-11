<?php

class CommunityController extends BaseController {

	public function index()
	{
		return View::make('community.index');
	}

   public function users()
   {
      $users = User::all();
      return View::make('community.users', array('users' => $users));
   }

   public function user($id)
   {
      $user = User::findOrFail($id);
      return View::make('community.user', array('user' => $user));
   }

   public function postUpdate($id)
   {
      $user = User::findOrFail($id);
      return View::make('community.user', array('user' => $user));
   }

   public function page($slug)
   {
      return View::make('community.' . $slug);
   }

}
