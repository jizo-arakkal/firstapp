<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromoGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promo_group', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('group_name', 100);
			$table->dateTime('created_date')->default('0000-00-00 00:00:00');
			$table->integer('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promo_group');
	}

}
