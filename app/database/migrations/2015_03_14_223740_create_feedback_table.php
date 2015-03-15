<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedback', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('offer_id');
			$table->integer('user_id');
			$table->boolean('damage')->default(false);
			$table->boolean('malfunction')->default(false);
			$table->boolean('description')->default(false);
			$table->integer('rate');
			$table->text('experience');
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
		Schema::drop('feedback');
	}

}
