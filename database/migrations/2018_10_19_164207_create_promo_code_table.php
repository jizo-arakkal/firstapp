<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromoCodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promo_code', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('promo_title', 200);
			$table->date('from_date');
			$table->date('to_date');
			$table->string('promocode', 100);
			$table->integer('coins');
			$table->integer('max_usage');
			$table->integer('benfited_user_count');
			$table->integer('promo_group');
			$table->integer('promo_type');
			$table->integer('merchant_id');
			$table->integer('maintained_by');
			$table->integer('city_id');
			$table->text('user_list', 65535);
			$table->timestamp('date_created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('status');
			$table->integer('discount');
			$table->integer('is_individual_promo');
			$table->boolean('deleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promo_code');
	}

}
