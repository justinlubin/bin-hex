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

// Start
Route::get('/', [
    'as' => 'start',
    'uses' => 'UsersController@getLogIn'
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
Route::get('users/leaderboard', [
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
])->before('auth');
Route::post('game/multiplayer', [
    'as' => 'game.postMultiplayer',
    'uses' => 'GameController@postMultiPlayerGame'
])->before('auth');
// Update Score
Route::post('game/update', [
    'uses' => 'GameController@postUpdate'
]);

// Settings
Route::get('settings', [
    'as' => 'settings',
    'uses' => 'SettingsController@getSettings'
])->before('auth');
Route::post('settings/changeAttributes', [
    'as' => 'settings.changeAttributes',
    'uses' => 'SettingsController@changeAttributes'
]);