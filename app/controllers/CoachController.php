<?php

class CoachController extends BaseController {


	/*
	|--------------------------------------------------------------------------
	| Coach Controller
	|--------------------------------------------------------------------------
	|
	|	Display the Assignment page
	|
	|	Route::get('/assign', 'CoachController@getAssignment');
	|
	*/
	public function getAssignment() {

		if (Auth::check() && Auth::user()->usertype == 'coach') {
		# Send them to the homepage
			return View::make('/assign');
		}
		else {
			return View::make('login');
		}
	}



	/*
	|--------------------------------------------------------------------------
	| Coach Controller
	|--------------------------------------------------------------------------
	|
	|	Adds a new Client user
	|
	|	Route::post('/coach/client', 'CoachController@postClient');
	|
	*/
	public function postClient() {

		$client = new User;
		$client->username = Input::get('username');
		$client->firstname = Input::get('firstname');
		$client->lastname = Input::get('lastname');
		$client->email    = Input::get('email');
		$client->password = Hash::make(Input::get('password'));
		$client->usertype = 'client';

		
		# Try to add the user 
		try {
			$client->save();
		}
		# Fail
		catch (Exception $e) {
			return Redirect::to('/coach')->with('flash_message', 'Add client failed; please try again.')->withInput();
		}

		# redisplay the page showing the added Client
		return Redirect::to('/coach')->with('flash_message', 'Client added.');

	}


	/*
	|--------------------------------------------------------------------------
	| Coach Controller
	|--------------------------------------------------------------------------
	|
	|	Add a task to the Task Library
	|
	|	Route::post('/coach/task', 'CoachController@postTask');
	|
	*/

	public function postTask() {
		$task = new Task;
		$task->title        = Input::get('title');
		$task->description  = Input::get('description');

		# set additional properties if a file has been uploaded
		if (Input::hasFile('file')) {
			$file 			= Input::file('file');
			$task->filename = $file->getClientOriginalName();
			$task->mimetype = $file->getMimeType();
			$task->size		= $file->getSize();
			$task->file     = file_get_contents($file->getRealPath());

		}

		# Try to add the task
		try {
			$task->save();
		}
		# Fail
		catch (Exception $e) {
			return Redirect::to('/coach')->with('flash_message', 'Add task failed; please try again.');
		}

		# redisplay the page showing the added Task
		return Redirect::to('/coach')->with('flash_message', 'Task added.');
	}



	/*
	|--------------------------------------------------------------------------
	| Coach Controller
	|--------------------------------------------------------------------------
	|
	| Creates an assignment of selected tasks to the selected client
	|
	|	Route::post('/coach/assign', 'CoachController@postAssignment');
	|
	*/

	
	public function postAssignment()
	{
		$inputs = Input::all();
		foreach ($inputs as $key => $value) {
			if (Str::startsWith($key, 'task_id')) {
				try {
					# open task from db
					$task = Task::findOrFail($value);
	
					# create a new Assignment
					$assignment = new Assignment;
					$assignment->title = $task->title;
					$assignment->user_id = Input::get('client');
					$assignment->task_id = $value;
					$assignment->description = $task->description;
					$assignment->filename = $task->filename;
					$assignment->complete = false;
					$assignment->duedate = Input::get('duedate'.$value);

					# save the assignment
					$assignment->save();
				}
				# Fail
				catch (Exception $e) {
					return Redirect::to('/assign')->with('flash_message', 'Assignment failed; please try again.'.$e);
				}
			
			}
		}
		Session::put('client_id', Input::get('client'));
		
		# redisplay the page showing updates
		return Redirect::to('/assign')->with('client', Input::get('client'));

	}

}
