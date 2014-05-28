<?php

class TopicsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('topics')->delete();
		Topic::create(array('title' => 'Intro to Web Design',
						'summary' => 'Come learn the baics of web design, HTML and CSS, in a friendly workshop format.',
						'description' => 'Lorem ipsum dolor'));
	}

}
