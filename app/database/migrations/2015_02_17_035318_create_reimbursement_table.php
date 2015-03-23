<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReimbursementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reimbursement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id');
			$table->float('cost');
			$table->text('response');
			$table->boolean('resolved');
			$table->boolean('dispute')->default(false);
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
		Schema::drop('reimbursement');
	}

}
