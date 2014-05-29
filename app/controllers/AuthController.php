<?php

class AuthController extends Controller {

	public function getLogin()
	{
		return View::make('auth.login');
	}

	public function postLogin()
	{

		// is there an event id lurking here? save it for later, if so.
		Session::put('attend_event_id', Input::get('event_id'));

		$credentials = Input::only(
			'email', 'password'
		);

		// $rules = array('email' => 'unique:users,email');
		// $validator = Validator::make($input, $rules);

		if(Input::get('login')){

			if(Auth::attempt($credentials, true)){
				// todo: future CTA opportunity.
				Alert::success('Welcome back, ' . Auth::user()->name . '!')->flash();
				return Redirect::intended('/');
			}

			Alert::warning("Couldn't log you in. Bad email / password combo.");
			return View::make('auth.login');

		} elseif(Input::get('signup')){

			$email = Input::get('email');
			$user = User::firstOrNew(array('email' => $email));

			if($user->id):
				if(Auth::attempt($credentials)):
					Alert::success("Oh hey, you already have an account with this email address! (And you logged in successfully, too — good to see you!")->flash();
					return Redirect::intended('/');
				else:
					Alert::danger('You tried to create a new account using ' . $email . ', but an account already exists with that email, and your password was incorrect. Try one of these: <ul><li>Log In in with a different password below</li><li><a href="' . route('password.remind', array('email' => $email)) . '">Reset your password</a></li><li>Create an account with a different email address — just click \'Sign Up\' button instead of \'Log In.\'</li><li>Contact us if you get stuck: <a href="mailto:seattlefreeschool@gmail.com">seattlefreeschool@gmail.com</a>');
					return View::make('auth.login');
				endif;
			endif;

			// validation here.

			$user->email = Input::get('email');
			$email_pieces = explode('@', $user->email);
			$user->name = $email_pieces[0];
			$user->password = Input::get('password');
			$user->save();
			Auth::attempt($credentials);

			return View::make('auth.finish');

		}

	}

	public function getLogout()
	{
		Auth::logout();
		Alert::info("You are now logged out. Hey, come back soon, though!")->flash();
		return Redirect::to('/');
	}

	public function postLogout()
	{
		Auth::logout();
	}

}
