<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChargeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charge', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('charge_id');
			$table->string('card_id');
			$table->float('charge');
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
		Schema::drop('charge');
	}

}
