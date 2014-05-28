<?php

class LocationsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('locations')->delete();
		Location::create(array('title' => 'Seattle Public Library - Central Library',
						'address' => '1000 4th Ave',
						'zip_code' => '98104',
						'phone' => '2063864636',
						'url' => 'http://www.spl.org/locations/central-library',
						'description' => 'Seattle\'s iconic downtown library location at 4th and Spring'));
	}

}
