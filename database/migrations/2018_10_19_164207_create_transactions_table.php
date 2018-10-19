<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('user_id', 30);
			$table->string('mode', 20);
			$table->string('amount', 10);
			$table->timestamp('valid_from')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('valid_upto')->default('0000-00-00 00:00:00');
			$table->string('status', 30);
			$table->string('fname', 30);
			$table->string('lname', 30);
			$table->string('city', 30);
			$table->string('state', 30);
			$table->string('country', 30);
			$table->string('email', 40);
			$table->integer('phone');
			$table->string('discount', 20);
			$table->string('net_amount_debit', 20);
			$table->timestamp('added_on')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('productinfo', 300);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}

}
