<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHookersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hookers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('rankNeeded');
			$table->integer('payout');
			$table->integer('visit');
			$table->integer('price');
			$table->integer('special');
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
		Schema::drop('hookers');
	}

}
