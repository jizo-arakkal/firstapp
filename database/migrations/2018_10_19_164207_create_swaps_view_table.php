<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSwapsViewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('swaps_view', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('swap_id', 30);
			$table->integer('view_count');
			$table->text('view_details');
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
		Schema::drop('swaps_view');
	}

}
