<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCreditsSummaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credits_summary', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('first_name', 100)->nullable();
			$table->string('user_id', 30);
			$table->integer('total_credits');
			$table->integer('rem_credits');
			$table->string('plan_name', 30);
			$table->string('txn_id', 40);
			$table->string('mode', 100)->nullable();
			$table->string('productinfo', 300)->nullable();
			$table->string('amount', 20)->nullable();
			$table->string('status', 20)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('phone', 100)->nullable();
			$table->string('error_Message', 200)->nullable();
			$table->string('name_on_card', 200)->nullable();
			$table->string('bank_ref_num', 100)->nullable();
			$table->string('bankcode', 100)->nullable();
			$table->string('cardnum', 100)->nullable();
			$table->string('payuMoneyId', 100)->nullable();
			$table->string('discount', 100)->nullable();
			$table->string('net_amount_debit', 100)->nullable();
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
		Schema::drop('credits_summary');
	}

}
