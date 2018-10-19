<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLvLikeShareTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lv_like_share', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('lv_id', 30);
			$table->integer('like_count');
			$table->text('like_details');
			$table->integer('share_count');
			$table->text('share_details');
			$table->integer('view_count');
			$table->text('view_details');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lv_like_share');
	}

}
