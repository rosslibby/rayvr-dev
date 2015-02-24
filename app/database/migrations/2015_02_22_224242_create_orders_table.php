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
			$table->string('confirmation_number');
			$table->integer('shipping_claim');
			$table->boolean('reimbursed')->default(false);
			$table->boolean('disputed')->default(false);
			$table->boolean('paid_shipping')->default(false);
			$table->float('cost');
			$table->string('review');
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
