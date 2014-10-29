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
Route::get('signup/requisitos/{id}', 'registroController@productos');

Route::group(array('before' => array('auth', 'cancerbero', 'menu')), function() {
	Route::get('/', array('as'=>'index.index', 'uses'=>'homeController@index'));
	//=== CATALOGOS
	Route::resource('catalogos/productos', 'productosController');
	Route::resource('catalogos/requerimientos', 'requerimientosController');
	Route::resource('catalogos/tratados', 'tratadosController');
	Route::resource('catalogos/periodos', 'periodosController');
	Route::resource('catalogos/movimientos', 'movimientosController');
	Route::get('catalogos/productorequerimiento/{id}', array('as'=>'catalogos.productorequerimiento.index', 'uses'=>'productorequerimientosController@index'));
	Route::post('catalogos/productorequerimiento/crear', array('as'=>'catalogos.productorequerimiento.store', 'uses'=>'productorequerimientosController@store'));	

	//=== CERTIFICADOS
	Route::get('certificados/generar',array('as'=>'certificados.generar','uses'=>'certificadosController@generarPDF'));
	//=== SOLICITUDES 
	Route::resource('catalogos/solicitudespendientes', 'solicitudesPendientesController');
	Route::get('solicitudespendientes/inscripciones', array('as'=>'solicitudespendientes.inscripciones', 'uses'=>'solicitudesPendientesController@inscripcionesPendientes'));
	Route::get('catalogos/solicitudespendientes/datossolicitud/{id}', array('as'=>'catalogos.solicitudespendientes.datossolicitud', 'uses'=>'solicitudesPendientesController@datosSolicitud'));
	Route::post('catalogos/solicitudespendientes/autorizar/{id}', array('as'=>'catalogos.solicitudespendientes.autorizar', 'uses'=>'solicitudesPendientesController@autorizar'));
});
