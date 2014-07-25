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

// DEBUG
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
Route::get('/get-environment',function() {
    echo "Environment: ".App::environment();
});
Route::get('/trigger-error',function() {
    $foo = new Foobar;
});


// Start
Route::get('/', [
    'as' => 'start',
    'uses' => 'HomeController@getStart'
]);

// Users
Route::get('users/all', [
    'as' => 'users.all',
    'uses' => 'UsersController@getAll'
]);
Route::get('users/profile/{user}', [
    'as' => 'users.profile',
    'uses' => 'UsersController@getProfile'
]);
Route::get('users/logIn', [
    'as' => 'users.getLogIn',
    'uses' => 'UsersController@getLogIn'
]);
Route::get('users/signUp', [
    'as' => 'users.getSignUp',
    'uses' => 'UsersController@getSignUp'
]);
Route::post('users/logIn', [
    'as' => 'users.postLogIn',
    'uses' => 'UsersController@postLogIn'
]);
Route::post('users/signUp', [
    'as' => 'users.postSignUp',
    'uses' => 'UsersController@postSignUp'
]);
Route::get('users/logout', [
    'as' => 'users.getLogOut',
    'uses' => 'UsersController@getLogOut'
]);
Route::get('/users/leaderboard', [
    'as' => 'users.leaderboard',
    'uses' => 'UsersController@getLeaderboard'
]);

// Game
Route::get('game/lobby', [
    'as' => 'game.lobby',
    'uses' => 'GameController@getLobby'
])->before('auth');
Route::get('game/singleplayer', [
    'as' => 'game.getSinglePlayer',
    'uses' => 'GameController@getSinglePlayerGame'
])->before('auth');;
Route::post('game/multiplayer', [
    'as' => 'game.postMultiplayer',
    'uses' => 'GameController@postMultiPlayerGame'
])->before('auth');
// Update Score
Route::post('game/update', [
    'uses' => 'GameController@postUpdate'
]);