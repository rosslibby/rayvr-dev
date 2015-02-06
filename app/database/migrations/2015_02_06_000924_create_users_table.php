<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_token')->nullable();
			$table->string('invite_code');
			$table->string('invited_by');
			$table->string('first_name');
			$table->string('last_name');
			$table->boolean('business');
			$table->string('business_name');
			$table->string('address');
			$table->string('address_2');
			$table->string('city');
			$table->string('state');
			$table->string('zip');
			$table->string('country');
			$table->string('phone');
			$table->integer('current');
			$table->string('confirm')->default(MD5(RAND()));
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
		Schema::drop('users');
	}

}
