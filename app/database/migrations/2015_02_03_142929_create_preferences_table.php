<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreferencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preferences', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->boolean('prime');
			$table->string('business_name');
			$table->string('address_1');
			$table->string('address_2');
			$table->string('city');
			$table->string('state');
			$table->string('zip');
			$table->string('country');
			$table->string('phone');
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
		Schema::drop('preferences');
	}

}
