<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveClassDetailsToEvent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function(Blueprint $table)
		{
			$table->string('title', 255)->default('')->after('id');
			$table->string('summary', 100)->default('')->after('title');
			$table->text('description')->default('')->after('slug');
		});

		foreach(ClassEvent::with('topic')->get() as $event){
			$event->title = $event->topic->title;
			$event->summary = $event->topic->summary;
			$event->description = $event->topic->description;
			$event->save();
		}

		// make appropriate fields nullable
		// populate them
		// un-make the appropriate fields nullable.
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events', function($table){
			$table->dropColumn('title', 'summary', 'description');
		});
	}

}
