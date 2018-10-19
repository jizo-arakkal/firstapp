<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditsTransactionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credits_transaction', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('txn_id', 40);
			$table->string('user_id', 30);
			$table->string('type_id', 30);
			$table->timestamp('valid_from')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('valid_until')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('credits_transaction');
	}

}
