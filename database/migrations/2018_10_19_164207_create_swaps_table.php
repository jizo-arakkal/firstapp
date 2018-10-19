<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSwapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('swaps', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('swap_id', 30);
			$table->string('user_id', 30)->nullable();
			$table->string('title', 150)->nullable();
			$table->text('description', 65535)->nullable();
			$table->integer('is_paid')->default(0);
			$table->text('images', 65535)->nullable();
			$table->string('cat_id', 70)->nullable();
			$table->text('location', 65535)->nullable();
			$table->string('latitude', 30)->nullable();
			$table->string('longitude', 30)->nullable();
			$table->string('for_goods', 100)->nullable();
			$table->string('for_services', 100)->nullable();
			$table->string('for_price', 10)->nullable();
			$table->integer('for_any')->default(0);
			$table->integer('for_free')->default(0);
			$table->integer('status');
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
		Schema::drop('swaps');
	}

}
