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

		$topic = Topic::first();
		$location = Location::first();

		$event = ClassEvent::create(array('topic_id' => $topic->id,
						'location_id' => $location->id,
						'title' => $topic->title,
						'summary' => $topic->summary,
						'description' => $topic->description,
						'start' => $nextWeek->toDateTimeString(),
						'end' => $nextWeek->addHours(3)->toDateTimeString()));

		$jon = User::where('email', 'culvejc@gmail.com')->firstOrFail();
		$test = User::where('email', 'test_user@gmail.com')->firstOrFail();

		$event->users()->save($jon, array('type' => 'facilitator'));
		$event->users()->save($test);
	}

}
