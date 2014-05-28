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
		User::create(array('email' => 'culvejc@gmail.com', 'name' => 'Jon Culver', 'password' => Hash::make('seattlefreeschool123')));
		User::create(array('email' => 'test_user@gmail.com', 'name' => 'Test User', 'password' => Hash::make('seattlefreeschool123')));
	}

}
