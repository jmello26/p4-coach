<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function($table) {

			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->timestamps();
			$table->string('filename');
			$table->string('mimetype');
			$table->integer('size');
			
		});
		
		DB::statement("ALTER TABLE tasks ADD file MEDIUMBLOB");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('tasks');

	}

}
