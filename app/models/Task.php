<?php

class Task extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';

	/**
	 * The attributes of the class.
	 *
	 * 
	 */

	 public $id;
	 public $title;
	 public $description;
	 public $file;
	 public $filename;
}
