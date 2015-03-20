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
			$table->integer('timeframe');
			$table->string('code');
			$table->integer('quota');
			$table->boolean('prime')->default(false);
			$table->string('link');
			$table->string('review_link');
			$table->boolean('male');
			$table->boolean('female');
			$table->boolean('free_shipping')->default(false);
			$table->float('shipping_cost');
			$table->boolean('approved')->default(false);
			$table->string('exclusivity');
			$table->text('reason');
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
