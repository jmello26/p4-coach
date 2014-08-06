<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getLogin() {
		return View::make('login');
	}

	
	
	public function postLogin()	{
		$credentials = Input::only('username', 'password');

		if (Auth::attempt($credentials, $remember = true)) {
			if (Auth::user()->usertype == 'coach') {
				return Redirect::to('coach')->with('flash_message', 'Welcome Back Coach!');
			}
			else {
				return Redirect::to('/home')->with('flash_message', 'Welcome Back Client!');
			}
		}
		else {
			return Redirect::to('/login')->withInput()->with('flash_message', 'Log in failed; please try again.');
		}
	}


	public function getClient() {
		if (Auth::check() && Auth::user()->usertype == 'client') {
		# Send them to the homepage
			return View::make('/home');
		}
		else {
			return View::make('login');
		}
	}

	
	public function getCoach() {
		if (Auth::check() && Auth::user()->usertype == 'coach') {
		# Send them to the homepage
			return View::make('coach');
		}
		else {
			return View::make('login');
		}
	}	

	
	public function getFile($id) {
		try {
			$task = Task::find($id);
		}
		catch (Exception $e) {
			return $e;
		}

		$mimetype = $task->mimetype;
		$content = $task->file;
		
		$response = Response::make($content, 200);
		$response->header('Content-Type', $mimetype);
		return $response;
	}	


	public function getHome() {
		if (Auth::check()) {
		# Send them to the homepage
			return View::make('home');
		}
		else {
			return View::make('login');
		}
	}	


	public function getLogout() {
		# Log out
		Auth::logout();

		# Send them to the homepage
		return Redirect::to('/');
	}	
	
	
	public function postUpdate() {
		$inputs = Input::all();
		$completes = Input::get('complete');
		foreach ($inputs as $key => $value) {
			if (Str::startsWith($key, 'assign_id')) {
				try {
					$assignment = Assignment::findOrFail($value);
					foreach ($completes as $complete) {
						if ($value == $complete) {
							$assignment->complete = true;
							break;
						}
						else {
							$assignment->complete = false;
						}
					}

					# Try to save the assignment
					$assignment->save();
				}
				# Fail
				catch (Exception $e) {
					return Redirect::to('/home')->with('flash_message', 'Update failed; please try again.'.$e);
				}	
			}
		}
		return Redirect::to('/home')->withInput()->with('flash_message', 'Tasks updated.');
	}
	
}
