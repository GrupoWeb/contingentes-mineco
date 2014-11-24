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

Route::get('correo', function(){
	return View::make('emails/autorizacion')
		->with('nombre', 'Erick Marroquin')
		->with('fecha', '10/10/14 13:30')
		->with('estado', 'Aprobada')
		->with('observaciones', 'Aprobada sin problemas');
});


Route::get('signup', 'registroController@index');
Route::get('requerimientos/{id}/{tipo}', 'requerimientosController@getProductos');
Route::get('contingente/partidas/{id}', 'partidasController@getPartidas');

Route::group(array('before' => array('auth', 'cancerbero', 'menu')), function() {
	Route::get('/', array('as'=>'index.index', 'uses'=>'homeController@index'));
	//=== SOLICITUD DE EMISION
	Route::get('solicitud/emision', array('as'=>'solicitud.emision.index', 'uses'=>'emisionController@index'));
	//=== CONTINGENTES
	Route::resource('contingentes', 'contingentesController');
	Route::get('contingente/requerimientos/{id}', array('as'=>'contingente.requerimientos.index', 
		'uses'=>'contingenterequerimientosController@index'));
	Route::post('contingente/requerimientos/store', array('as'=>'contingente.requerimientos.store', 
		'uses'=>'contingenterequerimientosController@store'));
	//=== CATALOGOS
	
	Route::resource('requerimientos', 'requerimientosController');
	Route::resource('tratados', 'tratadosController');
	Route::resource('periodos', 'periodosController');
	Route::resource('catalogos/movimientos', 'movimientosController');

	//=== CERTIFICADOS
	Route::get('certificados/generar',array('as'=>'certificados.generar','uses'=>'certificadosController@generarPDF'));
	//=== SOLICITUDES 
	Route::resource('catalogos/solicitudespendientes', 'solicitudesPendientesController');
	Route::get('solicitudespendientes/inscripciones', array('as'=>'solicitudespendientes.inscripciones', 'uses'=>'solicitudesPendientesController@inscripcionesPendientes'));
	Route::get('catalogos/solicitudespendientes/datossolicitud/{id}', array('as'=>'catalogos.solicitudespendientes.datossolicitud', 'uses'=>'solicitudesPendientesController@datosSolicitud'));
	Route::post('catalogos/solicitudespendientes/autorizar/{id}', array('as'=>'catalogos.solicitudespendientes.autorizar', 'uses'=>'solicitudesPendientesController@autorizar'));
});
