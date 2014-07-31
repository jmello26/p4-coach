<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignments', function($table) {

			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('task_id')->unsigned();
			$table->string('name');
			$table->string('title');
			$table->text('description');
			$table->timestamp('duedate');
			$table->boolean('complete');
			$table->string('filename');
			$table->binary('file');
			$table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('task_id')->references('id')->on('tasks');

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
		Schema::drop('assignments');
	}

}
