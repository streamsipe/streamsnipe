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

Route::get('/', 'HomeController@showWelcome');

Route::group(array('prefix' => 'api'), function()
{
	Route::get('random', 'StreamsController@random');
	Route::get('random/{filter}', 'StreamsController@filterRandom');
});
