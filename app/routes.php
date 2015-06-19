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

Route::get('/', function() {
	return View::make('hello');
});

Route::api('v1', function () {  
	
	Route::post('login', [  
    	'uses'      => 'AuthenticateController@authenticate',
		'as'        => 'api.login'
	]);

	Route::get('validate_token',  array(
    	'protected' => true,
		'as'        =>  'api.validate_token',
		'uses'        => 'AuthenticateController@validateToken'
	));
	
	Route::get('todo', [  
    	'uses'      => 'TodoController@index',
		'as'        => 'todo.index',
		'protected' => true
	]);

	Route::post('todo', [  
		'uses'      => 'TodoController@store',
		'as'        => 'todo.store',
		'protected' => true
	]);

	Route::delete('todo/{id}', [  
    	'uses'      => 'TodoController@destroy',
		'as'        => 'todo.destroy',
		'protected' => true
	]);
	   	
});