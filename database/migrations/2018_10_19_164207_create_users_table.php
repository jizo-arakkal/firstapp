<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('user_id', 30)->nullable();
			$table->string('name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->date('dob')->nullable();
			$table->string('country_code', 5)->nullable();
			$table->string('mobile', 15)->nullable()->default('0');
			$table->string('email', 50)->nullable();
			$table->integer('email_verify')->nullable()->default(0);
			$table->string('password', 500)->nullable();
			$table->string('gender', 10)->nullable();
			$table->string('profile_picture', 40)->nullable();
			$table->string('location', 1000)->nullable();
			$table->string('latitude', 30)->nullable();
			$table->string('longitude', 30)->nullable();
			$table->integer('is_online')->nullable()->default(0);
			$table->text('email_verification_code', 65535)->nullable();
			$table->string('os_type', 20)->nullable();
			$table->string('device_id', 300)->nullable();
			$table->string('device_modal', 100)->nullable();
			$table->string('token_for_notification', 500)->nullable();
			$table->string('username', 50)->nullable();
			$table->string('user_type', 15)->nullable();
			$table->integer('dp_changed')->default(0)->comment('will change to 1, when user changes his profile pic');
			$table->string('profile_pic', 200)->nullable();
			$table->integer('cover_changed')->default(0);
			$table->string('cover_pic', 200)->nullable();
			$table->string('facebook_user_id', 100)->nullable();
			$table->text('facebook_cover_pic', 65535)->nullable();
			$table->text('facebook_profile_dp', 65535)->nullable();
			$table->integer('age')->nullable()->default(0);
			$table->string('google_user_id', 100)->nullable();
			$table->text('google_profile_dp', 65535)->nullable();
			$table->string('google_given_name', 110)->nullable();
			$table->string('google_family_name', 200)->nullable();
			$table->float('user_distance', 10, 0)->nullable()->default(0);
			$table->integer('user_status')->nullable()->default(0);
			$table->integer('allow_follow')->default(1);
			$table->integer('allow_comment')->default(1);
			$table->string('otp', 10)->nullable();
			$table->integer('otp_verify')->nullable()->default(0);
			$table->integer('blocked_by_admin')->nullable()->default(0);
			$table->text('api_token', 65535)->nullable()->comment('Authentication Key');
			$table->string('remember_token', 100)->nullable();
			$table->dateTime('date_of_registation')->nullable();
			$table->string('selected_categories', 150)->nullable();
			$table->timestamps();
			$table->string('register_via', 10)->nullable();
			$table->text('followers', 65535)->nullable()->comment('Who all are following a user');
			$table->text('following', 65535)->nullable()->comment('To whom a user following');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
