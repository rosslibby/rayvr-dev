<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAffiliateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliate', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user');
			$table->string('email');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('website');
			$table->string('invite_code');
			$table->boolean('active')->default(false);
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
		Schema::drop('affiliate');
	}

}
