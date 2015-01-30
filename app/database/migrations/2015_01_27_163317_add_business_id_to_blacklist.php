<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBusinessIdToBlacklist extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blacklist', function(Blueprint $table)
		{
			$table->integer('business_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('blacklist', function(Blueprint $table)
		{
			$table->dropColumn('business_id');
		});
	}

}
