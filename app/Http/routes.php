<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('home', ['uses' => 'HomeController@index']);
//Route::get('home', ['uses' => 'HomeController@home']);

// Authentication routes...
Route::get('auth/login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as' => 'login'
]);

Route::post('auth/login', 'Auth\AuthController@postLogin');


Route::get('auth/logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as' => 'logout'
]);
/*  --------------------------------------------------- */
Route::group(['middleware' => 'auth'], function()
{

	Route::get('/', [
		'uses' => 'HomeController@index',
		'as' => 'home'
	]);

	// Registration routes...
	Route::get('auth/register', [
		'uses' => 'Auth\AuthController@getRegister',
		'as' => 'register'
	]);
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Routes Administrador
	Route::group(array('prefix' => 'admin'), function() {
		// All Admins
		Route::get('/', ['uses' => 'AdminController@all','as' => 'admin.index']);
		// Ver Perfil Propio
	    Route::get('perfil', ['uses' => 'AdminController@profile','as' => 'admin.profile']); 
	    // Ver Perfil de un Administrador
	    Route::get('show/{id}', ['uses' => 'AdminController@show','as' => 'admin.show']);   
	    // Agregar Admin
		Route::get('add/', ['uses' => 'AdminController@index','as' => 'admin.create']);
	    Route::post('add', 'AdminController@create');
	 	// Editar Admin
	 	Route::get('edit/{id}', ['uses' => 'AdminController@edit','as' => 'admin.edit']);
	 	Route::put('edit/{id}', ['uses' => 'AdminController@update','as' => 'admin.update']);
	 	// Delete Admin 
	 	Route::get('delete/{id}',array('uses' => 'AdminController@delete', 'as' => 'admin.delete'));
	 	Route::delete('delete/{id}',array('uses' => 'AdminController@destroy', 'as' => 'admin.destroy'));
	 	// Desactivar Usuario
	 	Route::get('status/{id}',array('uses' => 'AdminController@status', 'as' => 'admin.status'));
	 	Route::put('status/{id}', 'AdminController@statusChange');
	 	// Resetar Password de Administrador
	 	Route::get('reset/{id}',array('uses' => 'AdminController@reset', 'as' => 'admin.reset'));
	 	Route::put('reset/{id}', 'AdminController@resetChange');
	 	// Generar Password	 	
	 		// Un Administrador genera el Password	
	 		Route::get('generate/{id}',array('uses' => 'AdminController@generate', 'as' => 'admin.generate'));
	 		Route::put('generate/{id}', 'AdminController@generatePassword');
	});	
	// Fin (Routes Administrador)

});
// Fin Middleware
/*  --------------------------------------------------- */
	// Olvido de Password
	Route::get('pass-lost',array('uses' => 'AdminController@lostPublic', 'as' => 'pass.lost'));
	Route::post('pass-lost', 'AdminController@lostPasswordPublic');
	// Recuperacion de Password - El Usuario Admin (Dueño de la Cuenta) genera su propio Password
	Route::get('pass-generate/{id}',array('uses' => 'AdminController@generatePublic', 'as' => 'pass.generate'));
	Route::put('pass-generate/{id}', 'AdminController@generatePasswordPublic');	

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


