<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->string('address', 255)->nullable();
			$table->string('address2', 255)->nullable();
			$table->string('city', 255)->default('Seattle');
			$table->string('state', 255)->default('WA');
			$table->string('zip_code', 5)->nullable();
			$table->string('phone', 10)->nullable();
			$table->string('url', 255)->nullable();
			$table->text('description', 255);
			$table->string('slug', 255);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations');
	}

}
