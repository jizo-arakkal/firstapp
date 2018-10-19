<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesOldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories_old', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('category_title', 20);
			$table->text('category_description', 65535);
			$table->integer('status');
			$table->string('bg_image', 100);
			$table->string('logo_image', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories_old');
	}

}
