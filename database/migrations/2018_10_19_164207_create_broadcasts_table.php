<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBroadcastsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('broadcasts', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('broadcast_id', 30);
			$table->string('user_id', 30)->nullable();
			$table->integer('current_broadcast')->default(0);
			$table->text('description', 65535)->nullable();
			$table->integer('is_paid')->default(0);
			$table->text('location', 65535);
			$table->string('latitude', 30)->nullable();
			$table->string('longitude', 30)->nullable();
			$table->string('cat_id', 70)->nullable();
			$table->timestamps();
			$table->boolean('status')->default(0);
			$table->text('view_to', 16777215)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('broadcasts');
	}

}
