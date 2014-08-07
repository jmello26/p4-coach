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


/* Display login page */
Route::get('/login', 'HomeController@getLogin');

/* Post login credentials */
Route::post('/login', 'HomeController@postLogin');

/* Display the coach's Admin page */
Route::get('/coach', 'HomeController@getCoach');

/* Display the client's Tasks page */
Route::get('/client', 'HomeController@getClient');

/* Post task updates from a client */
Route::post('/client/update', 'HomeController@postUpdate');

/* Display the client's Home page */
Route::get('/home', 'HomeController@getHome');

/* Log out */
Route::get('/logout', 'HomeController@getLogout');

/* Download the file associated with a Task*/
Route::get('/file/{id}', 'HomeController@getFile');

/* Show the Assignment page to coaches */
Route::get('/assign', 'CoachController@getAssignment');

/* Add a client */
Route::post('/coach/client', 'CoachController@postClient');

/* Add a task to the Task Library */
Route::post('/coach/task', 'CoachController@postTask');

/* Assign tasks to a client */
Route::post('/coach/assign', 'CoachController@postAssignment');


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

