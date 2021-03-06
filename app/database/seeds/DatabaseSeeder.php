<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersSeeder');
		$this->call('TopicsSeeder');
		$this->call('LocationsSeeder');
		$this->call('ClassEventsSeeder');
		$this->call('RoleTableSeeder');
	}

}
