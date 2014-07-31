<?php

class Assignment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	 public $id;
	 public $title;
	 public $description;
	 public $file;
	 public $filename;

	 
	public function assignment() {
		return $this->belongsTo('User');
	}
}
