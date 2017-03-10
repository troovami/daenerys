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
 	// Desactivar/Activar Usuario
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

	// Routes Pais
	Route::group(array('prefix' => 'pais'), function() {
	// All Paises
	Route::get('/', ['uses' => 'PaisController@index','as' => 'pais.index']);
	// Agregar Pais
	Route::get('add/', ['uses' => 'PaisController@create','as' => 'pais.create']);
    Route::post('add', 'PaisController@store');
    // Editar Pais
 	Route::get('edit/{id}', ['uses' => 'PaisController@edit','as' => 'pais.edit']);
 	Route::put('edit/{id}', ['uses' => 'PaisController@update','as' => 'pais.update']);	
 	// Ver Pais
    Route::get('show/{id}', ['uses' => 'PaisController@show','as' => 'pais.show']); 
    // Desactivar/Activar Pais
 	Route::get('status/{id}',array('uses' => 'PaisController@status', 'as' => 'pais.status'));
 	Route::put('status/{id}', 'PaisController@statusChange');	
 	// Delete Pais 
 	Route::get('delete/{id}',array('uses' => 'PaisController@delete', 'as' => 'pais.delete'));
 	Route::delete('delete/{id}',array('uses' => 'PaisController@destroy', 'as' => 'pais.destroy')); 	
	});
	// Fin (Routes Pais)

	// Routes Marca
	Route::group(array('prefix' => 'marca'), function() {
	// All Marcas
	Route::get('/', ['uses' => 'MarcaController@index','as' => 'marca.index']);
	// All Marcas Mobile
	Route::get('mobile', ['uses' => 'MarcaController@mobile','as' => 'marca.mobile']);
	// All Marcas Vehicle
	Route::get('vehicle', ['uses' => 'MarcaController@vehicle','as' => 'marca.vehicle']);
	// SEO Tipos Asociados
	Route::get('seo', ['uses' => 'MarcaController@seo','as' => 'marca.seo']);
	// Editar SEO Tipos Asociados
 	Route::get('seo/{id}', ['uses' => 'MarcaController@editSEO','as' => 'marca.edit_seo']);
 	Route::put('seo/{id}', ['uses' => 'MarcaController@updateSEO','as' => 'marca.update_seo']);
	// Agregar Marca
	Route::get('add/', ['uses' => 'MarcaController@create','as' => 'marca.create']);
    Route::post('add', 'MarcaController@store');
    // Editar Marca
 	Route::get('edit/{id}', ['uses' => 'MarcaController@edit','as' => 'marca.edit']);
 	Route::put('edit/{id}', ['uses' => 'MarcaController@update','as' => 'marca.update']);	
 	// Ver Marca
    Route::get('show/{id}', ['uses' => 'MarcaController@show','as' => 'marca.show']); 
    // Desactivar/Activar Marca
 	Route::get('status/{id}',array('uses' => 'MarcaController@status', 'as' => 'marca.status'));
 	Route::put('status/{id}', 'MarcaController@statusChange');	
 	// Delete Marca 
 	Route::get('delete/{id}',array('uses' => 'MarcaController@delete', 'as' => 'marca.delete'));
 	Route::delete('delete/{id}',array('uses' => 'MarcaController@destroy', 'as' => 'marca.destroy')); 	
 	// Prueba Marca 
 	Route::get('prueba',array('uses' => 'MarcaController@prueba', 'as' => 'marca.prueba'));
	});
	// Fin (Routes Marca)
	Route::get('ajax/{valor}', 'MarcaController@ajaxGlobal');
	Route::get('brand-search/{valor}', 'MarcaController@brandSearch');


	// Routes Modelo
	Route::group(array('prefix' => 'modelo'), function() {
	// All Modelos
	Route::get('/', ['uses' => 'ModeloController@index','as' => 'modelo.index']);
	// Agregar Modelo
	Route::get('add/', ['uses' => 'ModeloController@create','as' => 'modelo.create']);
    Route::post('add', 'ModeloController@store');
    // Editar Modelo
 	Route::get('edit/{id}', ['uses' => 'ModeloController@edit','as' => 'modelo.edit']);
 	Route::put('edit/{id}', ['uses' => 'ModeloController@update','as' => 'modelo.update']);	
 	// Ver Modelo
    Route::get('show/{id}', ['uses' => 'ModeloController@show','as' => 'modelo.show']); 
    // Desactivar/Activar Modelo
 	Route::get('status/{id}',array('uses' => 'ModeloController@status', 'as' => 'modelo.status'));
 	Route::put('status/{id}', 'ModeloController@statusChange');	
 	// Delete Modelo 
 	Route::get('delete/{id}',array('uses' => 'ModeloController@delete', 'as' => 'modelo.delete'));
 	Route::delete('delete/{id}',array('uses' => 'ModeloController@destroy', 'as' => 'modelo.destroy')); 	
	});
	// Fin (Routes Marca)
	


	// Routes Persona
	Route::group(array('prefix' => 'persona'), function() {
	// All Personas
	Route::get('/', ['uses' => 'PersonaController@index','as' => 'persona.index']);
	// Agregar Persona
	Route::get('add/', ['uses' => 'PersonaController@create','as' => 'persona.create']);
    Route::post('add', 'PersonaController@store');
    // Editar Persona
 	Route::get('edit/{id}', ['uses' => 'PersonaController@edit','as' => 'persona.edit']);
 	Route::put('edit/{id}', ['uses' => 'PersonaController@update','as' => 'persona.update']);	
 	// Ver Persona
    Route::get('show/{id}', ['uses' => 'PersonaController@show','as' => 'persona.show']); 
    // Desactivar/Activar Persona
 	Route::get('status/{id}',array('uses' => 'PersonaController@status', 'as' => 'persona.status'));
 	Route::put('status/{id}', 'PersonaController@statusChange');	
 	// Certificar Persona
 	Route::get('certificate/{id}',array('uses' => 'PersonaController@certificate', 'as' => 'persona.certificate'));
 	Route::put('certificate/{id}', 'PersonaController@certificateChange');
 	// Delete Persona 
 	Route::get('delete/{id}',array('uses' => 'PersonaController@delete', 'as' => 'persona.delete'));
 	Route::delete('delete/{id}',array('uses' => 'PersonaController@destroy', 'as' => 'persona.destroy')); 
 	// Resetar Password de una Persona
 	Route::get('reset/{id}',array('uses' => 'PersonaController@reset', 'as' => 'persona.reset'));
 	Route::put('reset/{id}', 'PersonaController@resetChange');
 	// Generar Password de una Persona	 	
 		// Un Administrador genera el Nuevo Password de una Persona
 		Route::get('generate/{id}',array('uses' => 'PersonaController@generate', 'as' => 'persona.generate'));
 		Route::put('generate/{id}', 'PersonaController@generatePassword');	
	});
	// Fin (Routes Persona)

	// Routes Vehiculo
	Route::group(array('prefix' => 'vehicles'), function() {
	// All Vehiculos
	Route::get('/', ['uses' => 'VehiculoController@index','as' => 'vehicles.index']);
	// All publicaciones Activas
	Route::get('publicaciones-activas/', ['uses' => 'VehiculoController@publicacionesActivas','as' => 'vehicles.publicaciones-activas']);
	// All publicaciones Inactivas
	Route::get('publicaciones-inactivas/', ['uses' => 'VehiculoController@publicacionesInactivas','as' => 'vehicles.publicaciones-inactivas']);
	// Ver Vehiculo
    Route::get('show/{id}', ['uses' => 'VehiculoController@show','as' => 'vehicles.show']);
	// Agregar Vehiculo
	/*
	Route::get('add/', ['uses' => 'VehiculoController@create','as' => 'vehicles.create']);
    Route::post('add', 'VehiculoController@store');
    */
    // Editar Marca
 	/*
 	Route::get('edit/{id}', ['uses' => 'MarcaController@edit','as' => 'vehicles.edit']);
 	Route::put('edit/{id}', ['uses' => 'MarcaController@update','as' => 'vehicles.update']);	
 	*/
 	 
    // Desactivar/Activar Vehiculo
 	Route::get('status/{id}',array('uses' => 'VehiculoController@status', 'as' => 'vehicles.status'));
 	Route::put('status/{id}', 'VehiculoController@statusChange');	
 	// Delete Vehiculo 
 	Route::get('delete/{id}',array('uses' => 'VehiculoController@delete', 'as' => 'vehicles.delete'));
 	Route::delete('delete/{id}',array('uses' => 'VehiculoController@destroy', 'as' => 'vehicles.destroy')); 	
	});
	// Fin (Routes Vehiculo)

	// Routes Supervisor
	Route::group(array('prefix' => 'supervisor'), function() {
	// All Publicaciones 
	Route::get('publicaciones', ['uses' => 'SupervisorController@publicaciones','as' => 'supervisor.publicaciones']);
	// Editar Publicacion
	Route::post('publicaciones', ['uses' => 'SupervisorController@update','as' => 'supervisor.publicaciones']);
	// Ver Detalles de la Publicacion
	Route::get('detalle/{id}', ['uses' => 'SupervisorController@detalle','as' => 'supervisor.detalle']);
	// Activar
	Route::get('activar/{id}', ['uses' => 'SupervisorController@activar','as' => 'supervisor.activar']);
	// Desactivar
	Route::get('desactivar/{id}', ['uses' => 'SupervisorController@desactivar','as' => 'supervisor.desactivar']);
	});
	// Fin (Routes Supervisor)
	
	// Routes Operador
	Route::group(array('prefix' => 'operador'), function() {
		// All Publicaciones
		Route::get('revision', ['uses' => 'OperadorController@revision','as' => 'operador.revision']);
		// Ver Detalles de la Publicacion
		Route::get('detalle/{id}', ['uses' => 'OperadorController@detalle','as' => 'operador.detalle']);
		// Activar
		Route::get('activar/{id}', ['uses' => 'OperadorController@activar','as' => 'operador.activar']);
		// Desactivar
		Route::get('desactivar/{id}', ['uses' => 'OperadorController@desactivar','as' => 'operador.desactivar']);
		// Actualizar Imagenes
		Route::put('editar', ['uses' => 'OperadorController@editarPublicacion','as' =>'operador.editarPublicacion']);
	});
		// Fin (Routes Operador)

	// Routes Telefono
	Route::group(array('prefix' => 'telefono'), function() {
	// All Telefonos Tablets and Smartwach
	Route::get('/', ['uses' => 'TelefonoController@index','as' => 'telefono.index']);
	// All Telefonos
	Route::get('/mobile', ['uses' => 'TelefonoController@mobile','as' => 'telefono.mobile']);
	// All Smartwach
	Route::get('/smartwatch', ['uses' => 'TelefonoController@smartwatch','as' => 'telefono.smartwatch']);
	// All Tablets
	Route::get('/tablet', ['uses' => 'TelefonoController@tablet','as' => 'telefono.tablet']);
	// Agregar Telefono
	Route::get('add/', ['uses' => 'TelefonoController@create','as' => 'telefono.create']);
    Route::post('add', 'TelefonoController@store');
    // Editar Telefono
 	Route::get('edit/{id}', ['uses' => 'TelefonoController@edit','as' => 'telefono.edit']);
 	Route::put('edit/{id}', ['uses' => 'TelefonoController@update','as' => 'telefono.update']);	
 	// Ver Telefono
    Route::get('show/{id}', ['uses' => 'TelefonoController@show','as' => 'telefono.show']); 
    // Desactivar/Activar Telefono
 	Route::get('status/{id}',array('uses' => 'TelefonoController@status', 'as' => 'telefono.status'));
 	Route::put('status/{id}', 'TelefonoController@statusChange');	
 	// Delete Telefono 
 	Route::get('delete/{id}',array('uses' => 'TelefonoController@delete', 'as' => 'telefono.delete'));
 	Route::delete('delete/{id}',array('uses' => 'TelefonoController@destroy', 'as' => 'telefono.destroy')); 
 	//Combo
 	Route::post('dep_modelo','TelefonoController@dep_modelo');	
 	});
	// Fin (Routes Telefono)

	// Routes Noticias
	Route::group(array('prefix' => 'noticia'), function() {
	// All Noticias 
	Route::get('/', ['uses' => 'NoticiaController@index','as' => 'noticia.index']);
	// Agregar Noticia
	Route::get('add/', ['uses' => 'NoticiaController@create','as' => 'noticia.create']);
    Route::post('add', 'NoticiaController@store');
    // Editar Noticia
 	Route::get('edit/{id}', ['uses' => 'NoticiaController@edit','as' => 'noticia.edit']);
 	Route::put('edit/{id}', ['uses' => 'NoticiaController@update','as' => 'noticia.update']);	
 	// Ver Noticia
    Route::get('show/{id}', ['uses' => 'NoticiaController@show','as' => 'noticia.show']); 
    // Desactivar/Activar Telefono
 	Route::get('status/{id}',array('uses' => 'NoticiaController@status', 'as' => 'noticia.status'));
 	Route::put('status/{id}', 'NoticiaController@statusChange');	
 	// Delete Noticia 
 	Route::get('delete/{id}',array('uses' => 'NoticiaController@delete', 'as' => 'noticia.delete'));
 	Route::delete('delete/{id}',array('uses' => 'NoticiaController@destroy', 'as' => 'noticia.destroy')); 
 	});
	// Fin (Routes Noticias)






	// Routes Especificaciones

	// Redes
	Route::group(array('prefix' => 'redes'), function() {
	
	// All Redes
	Route::get('/', ['uses' => 'EspecificacionesController@redes','as' => 'redes.index']);

	// All Redes->Tecnologia
	Route::get('/tecnologia', ['uses' => 'EspecificacionesController@tecnologia','as' => 'redes.tecnologia']);
	// Agregar Redes->Tecnologia
	Route::get('/tecnologia/add', ['uses' => 'EspecificacionesController@create_tecnologia','as' => 'redes.create_tecnologia']);
    Route::post('/tecnologia/add', 'EspecificacionesController@store_tecnologia');
    // Editar Redes->Tecnologia
 	Route::get('/tecnologia/edit/{id}', ['uses' => 'EspecificacionesController@edit_tecnologia','as' => 'redes.edit_tecnologia']);
 	Route::put('/tecnologia/edit/{id}', ['uses' => 'EspecificacionesController@update_tecnologia','as' => 'redes.update_tecnologia']);	
 	// Ver Redes->Tecnologia
    Route::get('/tecnologia/show/{id}', ['uses' => 'EspecificacionesController@show_tecnologia','as' => 'redes.show_tecnologia']); 
    // Desactivar/Activar Redes->Tecnologia
 	Route::get('/tecnologia/status/{id}',['uses' => 'EspecificacionesController@status_tecnologia', 'as' => 'redes.status_tecnologia']);
 	Route::put('/tecnologia/status/{id}', 'EspecificacionesController@statusChange_tecnologia');	
 	// Delete Redes->Tecnologia 
 	Route::get('/tecnologia/delete/{id}',['uses' => 'EspecificacionesController@delete_tecnologia', 'as' => 'redes.delete_tecnologia']);
 	Route::delete('/tecnologia/delete/{id}',['uses' => 'EspecificacionesController@destroy_tecnologia', 'as' => 'redes.destroy_tecnologia']); 

	// All  Redes->Bandas
	Route::get('/bandas', ['uses' => 'EspecificacionesController@bandas','as' => 'redes.bandas']);
	// Agregar Redes->Bandas
	Route::get('/bandas/add', ['uses' => 'EspecificacionesController@create_banda','as' => 'redes.create_banda']);
    Route::post('/bandas/add', 'EspecificacionesController@store_banda');
    // Editar Redes->Bandas
 	Route::get('/bandas/edit/{id}', ['uses' => 'EspecificacionesController@edit_banda','as' => 'redes.edit_banda']);
 	Route::put('/bandas/edit/{id}', ['uses' => 'EspecificacionesController@update_banda','as' => 'redes.update_banda']);// Ver Redes->Bandas
    Route::get('/bandas/show/{id}', ['uses' => 'EspecificacionesController@show_banda','as' => 'redes.show_banda']); 
    // Desactivar/Activar Redes->Bandas
 	Route::get('/bandas/status/{id}',['uses' => 'EspecificacionesController@status_banda', 'as' => 'redes.status_banda']);
 	Route::put('/bandas/status/{id}', 'EspecificacionesController@statusChange_banda');	
 	// Delete Redes->Bandas 
 	Route::get('/bandas/delete/{id}',['uses' => 'EspecificacionesController@delete_banda', 'as' => 'redes.delete_banda']);
 	Route::delete('/bandas/delete/{id}',['uses' => 'EspecificacionesController@destroy_banda', 'as' => 'redes.destroy_banda']); 


	// All  Redes->Operadoras
	Route::get('/operadoras', ['uses' => 'EspecificacionesController@operadoras','as' => 'redes.operadoras']);
	// Agregar Redes->Operadoras
	Route::get('/operadoras/add', ['uses' => 'EspecificacionesController@create_operadora','as' => 'redes.create_operadora']);
    Route::post('/operadoras/add', 'EspecificacionesController@store_operadora');
    // Editar Redes->Operadoras
 	Route::get('/operadoras/edit/{id}', ['uses' => 'EspecificacionesController@edit_operadora','as' => 'redes.edit_operadora']);
 	Route::put('/operadoras/edit/{id}', ['uses' => 'EspecificacionesController@update_operadora','as' => 'redes.update_operadora']);
 	// Ver Redes->Operadoras
    Route::get('/operadoras/show/{id}', ['uses' => 'EspecificacionesController@show_operadora','as' => 'redes.show_operadora']); 
    // Desactivar/Activar Redes->Operadoras
 	Route::get('/operadoras/status/{id}',['uses' => 'EspecificacionesController@status_operadora', 'as' => 'redes.status_operadora']);
 	Route::put('/operadoras/status/{id}', 'EspecificacionesController@statusChange_operadora');	
 	// Delete Redes->Operadoras 
 	Route::get('/operadoras/delete/{id}',['uses' => 'EspecificacionesController@delete_operadora', 'as' => 'redes.delete_operadora']);
 	Route::delete('/operadoras/delete/{id}',['uses' => 'EspecificacionesController@destroy_operadora', 'as' => 'redes.destroy_operadora']);

 	// All  Redes->Tecnologias/Frecuencias
	Route::get('/tecno_frec', ['uses' => 'EspecificacionesController@tecno_frec','as' => 'redes.tecno_frec']);
	// Agregar  Redes->Tecnologias/Operadoras
	Route::get('/tecno_frec/add', ['uses' => 'EspecificacionesController@create_tecno_frec','as' => 'redes.create_tecno_frec']);
    Route::post('/tecno_frec/add', 'EspecificacionesController@store_tecno_frec');
    // Editar  Redes->Tecnologias/Operadoras
 	Route::get('/tecno_frec/edit/{id}', ['uses' => 'EspecificacionesController@edit_tecno_frec','as' => 'redes.edit_tecno_frec']);
 	Route::put('/tecno_frec/edit/{id}', ['uses' => 'EspecificacionesController@update_tecno_frec','as' => 'redes.update_tecno_frec']);
 	// Delete  Redes->Tecnologias/Operadoras
 	Route::get('/tecno_frec/delete/{id}',['uses' => 'EspecificacionesController@delete_tecno_frec', 'as' => 'redes.delete_tecno_frec']);
 	Route::delete('/tecno_frec/delete/{id}',['uses' => 'EspecificacionesController@destroy_tecno_frec', 'as' => 'redes.destroy_tecno_frec']);

 	// All  Redes->Operadora Tecnologias Frecuencias
	Route::get('/oper_tecno_frec', ['uses' => 'EspecificacionesController@oper_tecno_frec','as' => 'redes.oper_tecno_frec']);
	// Agregar  Redes->Tecnologias/Operadoras
	Route::get('/oper_tecno_frec/add', ['uses' => 'EspecificacionesController@create_oper_tecno_frec','as' => 'redes.create_oper_tecno_frec']);
    Route::post('/oper_tecno_frec/add', 'EspecificacionesController@store_oper_tecno_frec');
    // Editar  Redes->Tecnologias/Operadoras
 	Route::get('/oper_tecno_frec/edit/{id}', ['uses' => 'EspecificacionesController@edit_oper_tecno_frec','as' => 'redes.edit_oper_tecno_frec']);
 	Route::put('/oper_tecno_frec/edit/{id}', ['uses' => 'EspecificacionesController@update_oper_tecno_frec','as' => 'redes.update_oper_tecno_frec']);
 	// Delete  Redes->Tecnologias/Operadoras
 	Route::get('/oper_tecno_frec/delete/{id}',['uses' => 'EspecificacionesController@delete_oper_tecno_frec', 'as' => 'redes.delete_oper_tecno_frec']);
 	Route::delete('/oper_tecno_frec/delete/{id}',['uses' => 'EspecificacionesController@destroy_oper_tecno_frec', 'as' => 'redes.destroy_oper_tecno_frec']);

 	// Fin Redes
	});

	Route::group(array('prefix' => 'cuerpo'), function() {
	//All Cuerpo
	Route::get('/', ['uses' => 'EspecificacionesController@cuerpo','as' => 'cuerpo.index']);
	// All Cuerpo->SIMCARD
	Route::get('/simcard', ['uses' => 'EspecificacionesController@simcard','as' => 'cuerpo.simcard']);
	// Agregar Cuerpo->SIMCARD
	Route::get('/simcard/add/', ['uses' => 'EspecificacionesController@create_simcard','as' => 'cuerpo.create_simcard']);
    Route::post('/simcard/add', 'EspecificacionesController@store_simcard');
    // Editar Cuerpo->SIMCARD
 	Route::get('/simcard/edit/{id}', ['uses' => 'EspecificacionesController@edit_simcard','as' => 'cuerpo.edit_simcard']);
 	Route::put('/simcard/edit/{id}', ['uses' => 'EspecificacionesController@update_simcard','as' => 'cuerpo.update_simcard']);	
 	// Ver Cuerpo->SIMCARD
 	Route::get('/simcard/show/{id}', ['uses' => 'EspecificacionesController@show_simcard','as' => 'cuerpo.show_simcard']);
    // Desactivar/Activar Cuerpo->SIMCARD
 	Route::get('/simcard/status/{id}',['uses' => 'EspecificacionesController@status_simcard', 'as' => 'cuerpo.status_simcard']);
 	Route::put('/simcard/status/{id}', 'EspecificacionesController@statusChange_simcard');	
 	// Delete Cuerpo->SIMCARD 
 	Route::get('/simcard/delete/{id}',['uses' => 'EspecificacionesController@delete_simcard', 'as' => 'cuerpo.delete_simcard']);
 	Route::delete('/simcard/delete/{id}',['uses' => 'EspecificacionesController@destroy_simcard', 'as' => 'cuerpo.destroy_simcard']);


	// All Cuerpo->Color
	Route::get('/color', ['uses' => 'EspecificacionesController@color','as' => 'cuerpo.color']);
	// Agregar Cuerpo->Color
	Route::get('/color/add/', ['uses' => 'EspecificacionesController@create_color','as' => 'cuerpo.create_color']);
    Route::post('/color/add', 'EspecificacionesController@store_color');
    // Editar Cuerpo->Color
 	Route::get('/color/edit/{id}', ['uses' => 'EspecificacionesController@edit_color','as' => 'cuerpo.edit_color']);
 	Route::put('/color/edit/{id}', ['uses' => 'EspecificacionesController@update_color','as' => 'cuerpo.update_color']);	
 	// Ver Cuerpo->Color
    Route::get('/color/show/{id}', ['uses' => 'EspecificacionesController@show_color','as' => 'cuerpo.show_color']);// Desactivar/Activar Cuerpo->Color
 	Route::get('/color/status/{id}',['uses' => 'EspecificacionesController@status_color', 'as' => 'cuerpo.status_color']);
 	Route::put('/color/status/{id}', 'EspecificacionesController@statusChange_color');	
 	// Delete Cuerpo->Color 
 	Route::get('/color/delete/{id}',['uses' => 'EspecificacionesController@delete_color', 'as' => 'cuerpo.delete_color']);
 	Route::delete('/color/delete/{id}',['uses' => 'EspecificacionesController@destroy_color', 'as' => 'cuerpo.destroy_color']);
	//Fin Cuerpo
	});

	Route::group(array('prefix' => 'memoria'), function() {
	//All Memoria
	Route::get('/', ['uses' => 'EspecificacionesController@memoria','as' => 'memoria.index']);
	// All Memoria->UnidMed
	Route::get('/unidmed', ['uses' => 'EspecificacionesController@unidmed','as' => 'memoria.unidmed']);
	// Agregar Memoria->UnidMed
	Route::get('/unidmed/add/', ['uses' => 'EspecificacionesController@create_unidmed','as' => 'memoria.create_unidmed']);
    Route::post('/unidmed/add', 'EspecificacionesController@store_simcard');
    // Editar Memoria->UnidMed
 	Route::get('/unidmed/edit/{id}', ['uses' => 'EspecificacionesController@edit_unidmed','as' => 'memoria.edit_unidmed']);
 	Route::put('/unidmed/edit/{id}', ['uses' => 'EspecificacionesController@update_unidmed','as' => 'memoria.update_unidmed']);	
 	// Ver Memoria->UnidMed
    Route::get('/unidmed/show/{id}', ['uses' => 'EspecificacionesController@show_unidmed','as' => 'memoria.show_unidmed']);// Desactivar/Activar Memoria->UnidMed
 	Route::get('/unidmed/status/{id}',['uses' => 'EspecificacionesController@status_unidmed', 'as' => 'memoria.status_unidmed']);
 	Route::put('/unidmed/status/{id}', 'EspecificacionesController@statusChange_unidmed');	
 	// Delete Memoria->UnidMed
 	Route::get('/unidmed/delete/{id}',['uses' => 'EspecificacionesController@delete_unidmed', 'as' => 'memoria.delete_unidmed']);
 	Route::delete('/unidmed/delete/{id}',['uses' => 'EspecificacionesController@destroy_unidmed', 'as' => 'memoria.destroy_unidmed']);
	//Fin Memoria
	});

	Route::group(array('prefix' => 'pantalla'), function() {
	//All Pantalla
	Route::get('/', ['uses' => 'EspecificacionesController@pantalla','as' => 'pantalla.index']);
	// All Pantalla->Tecnologia
	Route::get('/tecnologia', ['uses' => 'EspecificacionesController@pantalla_tecnologia','as' => 'pantalla.tecnologia']);
	// Agregar Pantalla->Tecnologia
	Route::get('/tecnologia/add/', ['uses' => 'EspecificacionesController@create_pantalla_tecnologia','as' => 'pantalla.create_tecnologia']);
    Route::post('/tecnologia/add', 'EspecificacionesController@store_pantalla_tecnologia');
    // Editar Pantalla->Tecnologia
 	Route::get('/tecnologia/edit/{id}', ['uses' => 'EspecificacionesController@edit_pantalla_tecnologia','as' => 'pantalla.edit_tecnologia']);
 	Route::put('/tecnologia/edit/{id}', ['uses' => 'EspecificacionesController@update_pantalla_tecnologia','as' => 'pantalla.update_tecnologia']);	
 	// Ver Pantalla->Tecnologia
    Route::get('/tecnologia/show/{id}', ['uses' => 'EspecificacionesController@show_pantalla_tecnologia','as' => 'pantalla.show_tecnologia']);// Desactivar/Activar Pantalla->Tecnologia
 	Route::get('/tecnologia/status/{id}',['uses' => 'EspecificacionesController@status_pantalla_tecnologia', 'as' => 'pantalla.status_tecnologia']);
 	Route::put('/tecnologia/status/{id}', 'EspecificacionesController@statusChange_pantalla_tecnologia');	
 	// Delete Pantalla->Tecnologia
 	Route::get('/tecnologia/delete/{id}',['uses' => 'EspecificacionesController@delete_pantalla_tecnologia', 'as' => 'pantalla.delete_tecnologia']);
 	Route::delete('/tecnologia/delete/{id}',['uses' => 'EspecificacionesController@destroy_pantalla_tecnologia', 'as' => 'pantalla.destroy_tecnologia']);
	//Fin Pantalla
	});

	Route::group(array('prefix' => 'bateria'), function() {
	//All Bateria
	Route::get('/', ['uses' => 'EspecificacionesController@bateria','as' => 'bateria.index']);
	// All Bateria->Tipo
	Route::get('/tipo_bateria', ['uses' => 'EspecificacionesController@tipo_bateria','as' => 'bateria.tipo_bateria']);
	// Agregar Bateria->Tipo
	Route::get('/tipo_bateria/add/', ['uses' => 'EspecificacionesController@create_tipo_bateria','as' => 'bateria.create_tipo_bateria']);
    Route::post('tipo_bateria/add', 'EspecificacionesController@store_tipo_bateria');
    // Editar Bateria->Tipo
 	Route::get('/tipo_bateria/edit/{id}', ['uses' => 'EspecificacionesController@edit_tipo_bateria','as' => 'bateria.edit_tipo_bateria']);
 	Route::put('/tipo_bateria/edit/{id}', ['uses' => 'EspecificacionesController@update_tipo_bateria','as' => 'bateria.update_tipo_bateria']);	
 	// Ver Bateria->Tipo
    Route::get('/tipo_bateria/show/{id}', ['uses' => 'EspecificacionesController@show_tipo_bateria','as' => 'bateria.show_tipo_bateria']); 
    // Desactivar/Activar Bateria->Tipo
 	Route::get('/tipo_bateria/status/{id}',['uses' => 'EspecificacionesController@status_tipo_bateria', 'as' => 'bateria.status_tipo_bateria']);
 	Route::put('/tipo_bateria/status/{id}', 'EspecificacionesController@statusChange_tipo_bateria');	
 	// Delete Bateria->Tipo
 	Route::get('/tipo_bateria/delete/{id}',['uses' => 'EspecificacionesController@delete_tipo_bateria', 'as' => 'bateria.delete_tipo_bateria']);
 	Route::delete('/tipo_bateria/delete/{id}',['uses' => 'EspecificacionesController@destroy_tipo_bateria', 'as' => 'bateria.destroy_tipo_bateria']);
	//Fin Bateria
	});

	Route::group(array('prefix' => 'memoria'), function() {
	//All Memoria
	Route::get('/', ['uses' => 'EspecificacionesController@memoria','as' => 'memoria.index']);
	// All Memoria->UnidMed
	Route::get('/unidmed', ['uses' => 'EspecificacionesController@unidmed','as' => 'memoria.unidmed']);
	// Agregar Memoria->UnidMed
	Route::get('/unidmed/add/', ['uses' => 'EspecificacionesController@create_unidmed','as' => 'memoria.create_unidmed']);
    Route::post('/unidmed/add', 'EspecificacionesController@store_unidmed');
    // Editar Memoria->UnidMed
 	Route::get('/unidmed/edit/{id}', ['uses' => 'EspecificacionesController@edit_unidmed','as' => 'memoria.edit_unidmed']);
 	Route::put('/unidmed/edit/{id}', ['uses' => 'EspecificacionesController@update_unidmed','as' => 'memoria.update_unidmed']);	
 	// Ver Memoria->UnidMed
    Route::get('/unidmed/show/{id}', ['uses' => 'EspecificacionesController@show_unidmed','as' => 'memoria.show_unidmed']); 
    // Desactivar/Activar Memoria->UnidMed
 	Route::get('/unidmed/status/{id}',['uses' => 'EspecificacionesController@status_unidmed', 'as' => 'memoria.status_unidmed']);
 	Route::put('/unidmed/status/{id}', 'EspecificacionesController@statusChange_unidmed');	
 	// Delete Memoria->UnidMed
 	Route::get('/unidmed/delete/{id}',['uses' => 'EspecificacionesController@delete_unidmed', 'as' => 'memoria.delete_unidmed']);
 	Route::delete('/unidmed/delete/{id}',['uses' => 'EspecificacionesController@destroy_unidmed', 'as' => 'memoria.destroy_unidmed']);
	//Fin Memoria
	});

	Route::group(array('prefix' => 'plataforma'), function() {
	//All Plataforma
	Route::get('/', ['uses' => 'EspecificacionesController@plataforma','as' => 'plataforma.index']);
	// All Plataforma->OS
	Route::get('/so', ['uses' => 'EspecificacionesController@so','as' => 'plataforma.so']);
	// Agregar Plataforma->OS
	Route::get('/so/add/', ['uses' => 'EspecificacionesController@create_so','as' => 'plataforma.create_so']);
    Route::post('/so/add', 'EspecificacionesController@store_so');
    // Editar Plataforma->OS
 	Route::get('/so/edit/{id}', ['uses' => 'EspecificacionesController@edit_so','as' => 'plataforma.edit_so']);
 	Route::put('/so/edit/{id}', ['uses' => 'EspecificacionesController@update_so','as' => 'plataforma.update_so']);	
 	// Ver Plataforma->OS
    Route::get('/so/show/{id}', ['uses' => 'EspecificacionesController@show_so','as' => 'plataforma.show_so']); 
    // Desactivar/Activar Plataforma->OS
 	Route::get('/so/status/{id}',['uses' => 'EspecificacionesController@status_so', 'as' => 'plataforma.status_so']);
 	Route::put('/so/status/{id}', 'EspecificacionesController@statusChange_so');	
 	// Delete Plataforma->OS
 	Route::get('/so/delete/{id}',['uses' => 'EspecificacionesController@delete_so', 'as' => 'plataforma.delete_so']);
 	Route::delete('/so/delete/{id}',['uses' => 'EspecificacionesController@destroy_so', 'as' => 'plataforma.destroy_so']);
	//Fin Plataforma
	});
	// Fin Routes Especificaciones

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




