<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deposit', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->float('sum');
			$table->float('used')->default(0.0);
			$table->float('remaining');
			$table->string('currency');
			$table->string('signature');
			$table->string('status');
			$table->string('tx');
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
		Schema::drop('deposit');
	}

}
