<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLvCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lv_comments', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('lv_id', 30);
			$table->string('user_id', 30);
			$table->text('comment', 65535);
			$table->integer('hide')->default(0);
			$table->integer('is_delete')->default(0);
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
		Schema::drop('lv_comments');
	}

}
