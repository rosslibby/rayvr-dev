<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('business_id');
			$table->string('photo');
			$table->string('title');
			$table->text('description');
			$table->date('start');
			$table->date('end');
			$table->integer('quota');
			$table->boolean('gender');
			$table->boolean('prime');
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
		Schema::drop('offers');
	}

}
