<?php

class UsersSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
		User::create(array('email' => 'culvejc@gmail.com', 'name' => 'Jon Culver', 'password' => 'seattlefreeschool123'));
		User::create(array('email' => 'julian@schrenzel.net', 'name' => 'Julian Schrenzel', 'password' => 'seattlefreeschool123'));
		User::create(array('email' => 'test_user@gmail.com', 'name' => 'Test User', 'password' => 'abc123'));
	}

}
