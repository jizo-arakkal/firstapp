<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_notifications', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('from_user_id', 30);
			$table->string('to_user_id', 30);
			$table->string('link_id', 100)->nullable();
			$table->string('message', 400);
			$table->integer('is_shown')->default(0);
			$table->integer('is_hide')->default(0);
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
		Schema::drop('user_notifications');
	}

}
