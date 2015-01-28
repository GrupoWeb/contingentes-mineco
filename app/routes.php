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
Route::group(array('before' => array('tratados')), function() {
	Route::get('c/{id}',array('as'=>'certificados.generar','uses'=>'certificadosController@generarPDF'));
	Route::get('cuentacorriente/periodos/{id}', 'cuentacorrienteController@getPeriodos');
	Route::get('changetratado/{id}', 'dashboardController@changetratado');

	//=== SOLICITUD DE INSCRIPCION
	Route::resource('signup', 'inscripcionController');
	Route::get('signup/checkEmail', 'inscripcionController@validateEmail');

	//=== REQUERIMIENTOS
	Route::get('requerimientos/contingentes/{id}/{tipo}', 'requerimientosController@getContingentes');
	Route::get('requerimientos/contingentes/vacio', 'requerimientosController@getVacio');

	//=== CONTINGENTES
	Route::get('contingente/partidas/{id}', 'partidasController@getPartidas');
	Route::get('contingente/saldo/{id}', 'contingentesController@getSaldo');


	Route::group(array('before' => array('auth', 'cancerbero', 'menu')), function() {
		Route::get('/', array('as'=>'index.index', 'uses'=>'dashboardController@index'));
		
		//=== SOLICITUDES
		Route::resource('solicitud/asignacion', 'asignacionController', array('only'=>array('index','store')));
		Route::resource('solicitud/emision', 'emisionController', array('only'=>array('index','store')));
		Route::resource('solicitudespendientes/inscripcion', 'solicitudesinscripcionController',array('names' => array('index' => 'solicitudespendientes.inscripcion.index')));
		//Route::get('solicitudespendientes/inscripcion/',array('as'=>'solicitudespendientes.inscripcion.index','uses'=>'solicitudesinscripcionController@index'));
		Route::resource('solicitudespendientes/asignacion', 'solicitudesasignacionController');
		Route::resource('solicitudespendientes/emision', 'solicitudesemisionController');
		Route::resource('historicosolicitudes', 'historicosolicitudesController');
		
		//=== CONTINGENTES
		Route::get('contingente/requerimientos/{id}', array('as'=>'contingente.requerimientos.index','uses'=>'contingenterequerimientosController@index'));
		Route::post('contingente/requerimientos/store', array('as'=>'contingente.requerimientos.store','uses'=>'contingenterequerimientosController@store'));

		//=== CATALOGOS
		Route::resource('productos','productosController');
		Route::resource('tratados','tratadosController');
		Route::resource('requerimientos','requerimientosController');
		Route::resource('contingentes','contingentesController');
		Route::resource('periodos','periodosController');
		Route::resource('periodosasignaciones', 'periodosasignacionesController', array('only'=>array('index','store')));
		Route::resource('partidasarancelarias','contingentepartidaController');
		//Route::resource('catalogos/movimientos', 'movimientosController');

		//=== CERTIFICADOS
		Route::resource('certificados', 'certificadosController', array('only'=>array('index','show')));
		Route::get('certificados/anular/{id}', array('as'=>'certificados.anular', 'uses'=>'certificadosController@anular'));

		//=== REPORTES
		Route::resource('cuentacorriente', 'cuentacorrienteController', array('only'=>array('index','store')));
		Route::resource('empresas', 'empresasController', array('only'=>array('index','store')));
	});
});