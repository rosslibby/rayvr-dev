<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discount', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('admin_id');
			$table->integer('user_id');
			$table->boolean('active')->default(false);
			$table->timestamp('start_date');
			$table->timestamp('end_date');
			$table->integer('quota');
			$table->boolean('unlimited')->default(true);
			$table->string('code');
			$table->float('discount');
			$table->integer('times_used');
			$table->boolean('one_per_user')->default(true);
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
		Schema::drop('discount');
	}

}
