<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalvocalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('localvocals', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('lv_id', 30)->nullable();
			$table->string('user_id', 30)->nullable();
			$table->string('title', 150)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('images', 65535)->nullable();
			$table->string('cat_id', 70)->nullable();
			$table->text('location', 65535)->nullable();
			$table->string('latitude', 30)->nullable();
			$table->string('longitude', 30)->nullable();
			$table->integer('public');
			$table->integer('followers');
			$table->integer('status')->default(0);
			$table->text('last_activity', 65535);
			$table->string('last_activity_user_id', 30);
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
		Schema::drop('localvocals');
	}

}
