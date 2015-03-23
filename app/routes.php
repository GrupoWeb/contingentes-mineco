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

Route::get('temp',function(){
	return View::make('emails.solicitudinscripcion')
		->with('fecha','el dia de hoy')
		->with('nombre','el nombre');
});

//API
Route::group(array('before' => array('auth_basic')), function() {
	Route::get('api/certificado/{id}', 'apiController@certificado');
	Route::get('api/empresaestavigentexnit','apiController@empresavigente');
	Route::get('api/listadocontingentesnittratado','apiController@listadocontingentes');
	Route::get('api/partidasarancelariasxcontingente','apiController@partidascontingente');
	Route::get('api/cuentacorriente','apiController@cuentacorriente');
	Route::get('api/solicitudasignacion','apiController@solicitudasignacion');
	Route::get('api/solicitudemision','apiController@solicitudemision');
});


Route::group(array('before' => array('tratados')), function() {
	Route::get('c/{id}',array('as'=>'certificados.generar','uses'=>'certificadosController@generarPDF'));
	Route::get('cuentacorriente/periodos/{id}', 'cuentacorrienteController@getPeriodos');
	Route::get('cuentacorriente/empresas/{id}', 'cuentacorrienteempresasController@getEmpresas');
	Route::get('changetratado/{id}', 'dashboardController@changetratado');

	//=== SOLICITUD DE INSCRIPCION
	Route::resource('signup', 'inscripcionController');
	Route::post('signup/checkEmail', 'inscripcionController@validateEmail');
	Route::post('signup/checkNIT', 'inscripcionController@validateNIT');

	//=== REQUERIMIENTOS
	Route::get('requerimientos/contingentes/{id}/{tipo}', 'requerimientosController@getContingentes');
	Route::get('requerimientos/contingentes/vacio', 'requerimientosController@getVacio');
	Route::get('contingentes/tratado/{tratado}', 'inscripcionController@getContingentes');

	//=== CONTINGENTES
	Route::get('contingente/partidas/{id}', 'partidasController@getPartidas');
	Route::get('contingente/saldo/{id}', 'contingentesController@getSaldo');
  Route::get('contingente/saldoasignacion/{id}', 'contingentesController@getSaldoAsignacion');
  Route::get('contingente/paises/{id}', 'emisionController@getPaises');

	Route::group(array('before' => array('auth', 'cancerbero', 'menu')), function() {
		Route::get('/', array('as'=>'index.index', 'uses'=>'dashboardController@index'));
		
		//=== SOLICITUDES
		Route::resource('solicitud/asignacion', 'asignacionController', array('only'=>array('index','store')));
		Route::resource('solicitud/emision', 'emisionController', array('only'=>array('index','store')));
		Route::resource('solicitud/inscripcion', 'solicitudesinscripcionController', array('only'=>array('create','update')));
		Route::resource('solicitudespendientes/inscripcion', 'solicitudesinscripcionController',array('names' => array('index' => 'solicitudespendientes.inscripcion.index')));
		Route::resource('solicitudespendientes/asignacion', 'solicitudesasignacionController');
		Route::resource('solicitudespendientes/emision', 'solicitudesemisionController');

		Route::resource('historicosolicitudes/inscripcion', 'historicoinscripcionesController');
		Route::resource('historicosolicitudes/asignacion', 'historicoasignacionesController');
		Route::resource('historicosolicitudes/emision', 'historicoemisionesController');
		
		//=== CONTINGENTES
		Route::get('contingente/requerimientos/{id}', array('as'=>'contingente.requerimientos.index','uses'=>'contingenterequerimientosController@index'));
		Route::post('contingente/requerimientos/store', array('as'=>'contingente.requerimientos.store','uses'=>'contingenterequerimientosController@store'));

		//=== CATALOGOS
		Route::resource('productos','productosController');
		Route::resource('tratados','tratadosController');
		Route::resource('requerimientos','requerimientosController');
		Route::resource('contingentes','contingentesController');
		Route::resource('periodos','periodosController');
		Route::resource('periodosasignaciones','periodosasignacionesController', array('only'=>array('index','store')));
		Route::resource('partidasarancelarias','contingentepartidaController');
		Route::resource('paises','paisesController');
		Route::resource('unidadesmedida','unidadesmedidaController');
		Route::resource('usuarioempresas','usuariosdeempresaController');

		//=== CERTIFICADOS
		Route::resource('certificados', 'certificadosController', array('only'=>array('index','show')));
		Route::get('certificados/anular/{id}', array('as'=>'certificados.anular', 'uses'=>'certificadosController@anular'));
		Route::post('certificados/anular/{id}', array('as'=>'certificados.procesaranulacion', 'uses'=>'certificadosController@procesaranulacion'));
		Route::get('certificados/liquidar/{id}', array('as'=>'certificados.liquidar', 'uses'=>'certificadosController@liquidar'));
		Route::post('certificados/liquidar/{id}', array('as'=>'certificados.procesarliquidacion', 'uses'=>'certificadosController@procesarliquidacion'));

		//=== REPORTES
		Route::resource('cuentacorriente', 'cuentacorrienteController', array('only'=>array('index','store')));
		Route::resource('cuentacorrienteempresas', 'cuentacorrienteempresasController', array('only'=>array('index','store')));
		Route::resource('empresas', 'empresasController', array('only'=>array('index', 'store')));
		Route::get('tratado/graficas/saldo/{id}', array('as'=>'tratado.graficas.saldo', 'uses'=>'graficasController@saldo'));
	  
	  //=== ADMIN
	  Route::resource('usuarioswebservice', 'usuarioswebserviceController');
	});
});
