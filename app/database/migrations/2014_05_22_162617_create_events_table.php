<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('topic_id');
			$table->integer('location_id')->nullable();
			$table->string('one_off_location', 255)->nullable();
			$table->dateTime('start');
			$table->dateTime('end')->nullable();
			$table->boolean('is_all_day');
			$table->timestamps();
			$table->foreign('topic_id')->references('topics')->on('id');
			$table->foreign('location_id')->references('locations')->on('id');
		});

		Schema::create('event_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('event_id');
			$table->enum('type', array('facilitator', 'attendee'))->default('attendee');
			$table->timestamps();
			$table->unique(array('user_id', 'event_id'));
			$table->foreign('user_id')->references('users')->on('id');
			$table->foreign('event_id')->references('events')->on('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_users');
		Schema::drop('events');
	}

}
