<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('offer_id');
			$table->integer('user_id');
			$table->timestamp('mail_date');
			$table->string('confirmation_number')->default(NULL);
			$table->float('shipping_claim')->default(NULL);
			$table->boolean('reimbursed')->default(false);
			$table->integer('disputed')->default(NULL);
			$table->string('review')->default(NULL);
			$table->timestamp('reviewed');
			$table->boolean('completed')->default(false);
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
		Schema::drop('orders');
	}

}
