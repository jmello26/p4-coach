<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {

			$table->increments('id');
			$table->string('username')->unique();
			$table->string('password');
			$table->boolean('remember_token');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('type');
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
		//
		Schema::drop('users');

	}

}
