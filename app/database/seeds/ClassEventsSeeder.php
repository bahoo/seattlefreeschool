<?php

use Carbon\Carbon;

class ClassEventsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('events')->delete();
		DB::table('event_users')->delete();
		$nextWeek = Carbon::now()->addWeek();

		ClassEvent::create(array('topic_id' => Topic::first()->id,
						'location_id' => Location::first()->id,
						'start' => $nextWeek->toDateTimeString(),
						'end' => $nextWeek->addHours(3)->toDateTimeString()));

		$event = ClassEvent::firstOrFail();

		$jon = User::where('email', 'culvejc@gmail.com')->firstOrFail();
		$test = User::where('email', 'test_user@gmail.com')->firstOrFail();

		$event->users()->save($jon, array('type' => 'facilitator'));
		$event->users()->save($test);
	}

}
