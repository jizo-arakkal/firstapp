<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSwapsReportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('swaps_report', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('swap_id', 30);
			$table->string('user_id', 30);
			$table->integer('type');
			$table->text('remark', 65535)->nullable();
			$table->dateTime('created_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('swaps_report');
	}

}
