<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

/*
Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);
*/
/*
Route::post('/signup', 
    array(
        'before' => 'csrf', 
        function() {

            $user = new User;
			$user->username = Input::get('username');
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            }

            # Log the user in
            Auth::login($user);

            return Redirect::to('/')->with('flash_message', 'Welcome '. Auth::$user->$firstname . ' ' . Auth::$user->$lastname . '!');

        }
    )
);
*/

Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);


Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

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
    )
);


Route::get('/coach', function() {

	if (Auth::check()) {
    # Send them to the homepage
    //return Redirect::to('/home');
		return View::make('coach');
	}
	else {
		return View::make('login');
	}

});


Route::post('/coach/client', 
    array(
        'before' => 'csrf', 
        function() {

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


            return Redirect::to('/coach')->with('flash_message', 'Client added.');

        }
    )
);


Route::post('/coach/task', 
    array(
        'before' => 'csrf', 
        function() {

            $task = new Task;
			$task->title = Input::get('title');
			$task->description = Input::get('description');
			$task->filename = Input::get('filename');
            $task->file    = Input::get('file');

            # Try to add the user 
            try {
                $task->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/coach')->with('flash_message', 'Add task failed; please try again.')->withInput();
            }

            return Redirect::to('/coach')->with('flash_message', 'Task added.');

        }
    )
);


Route::get('/home', function() {

	if (Auth::check()) {
    # Send them to the homepage
    //return Redirect::to('/home');
		return View::make('home');
	}
	else {
		return View::make('login');
	}

});


Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

/*
Route::get('/seed', function() {

		$client = new User;
		$client->username = 'client';
		$client->usertype = 'client';
		$client->firstname = 'Test';
		$client->lastname = 'Client';
		$client->email = 'client@no-such-domain.com';
		$client->password = Hash::make('test');
		$client->save();

		$coach = new User;
		$coach->username = 'coach';
		$coach->usertype = 'coach';
		$coach->firstname = 'Test';
		$coach->lastname = 'Coach';
		$coach->email = 'coach@p4-life-coach-inc.com';
		$coach->password = Hash::make('test');
		$coach->save();

    return "Tables seeded";

});
*/


Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

