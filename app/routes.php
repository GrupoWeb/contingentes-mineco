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

//Legacy
Route::get('api/vupe/','apiController@vupeLegacy');

//Informativas
Route::get('/', array('as'=>'index.index', 'uses'=>'homeController@index'));
Route::get('acuerdoscomerciales', array('as'=>'index.index', 'uses'=>'homeController@acuerdoscomerciales'));
Route::get('manuales', array('as'=>'index.index', 'uses'=>'homeController@manuales'));

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

//FILTROS DE CERTIFICADOS
Route::get('certificados/contingentes/{id}', 'certificadosController@getcontingentes');
Route::get('certificados/periodos/{id}', 'certificadosController@getperiodos');
Route::get('certificados/empresas/{id}', 'certificadosController@getempresas');


Route::group(array('before' => array('tratados')), function() {
	Route::get('c/{id}',array('as'=>'certificados.generar','uses'=>'certificadosController@generarPDF'));
	Route::get('cuentacorriente/periodos/{id}', 'cuentacorrienteController@getPeriodos');
	Route::get('cuentacorriente/empresas/{id}', 'cuentacorrienteempresasController@getEmpresas');
	Route::get('utilizacion/contingentes/{id}', 'utilizacionController@getContingentes');
	Route::get('utilizacion/empresas/{id}', 'utilizacionController@getEmpresas');
	Route::get('changetratado/{id}', 'dashboardController@changetratado');
	Route::get('tratado/detalle/{id}', 'dashboardController@detalletratado');

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
		Route::get('inicio', array('as'=>'index.index', 'uses'=>'dashboardController@index'));
		
		//=== SOLICITUDES
		Route::resource('solicitud/asignacion', 'asignacionController', array('only'=>array('index','store')));
		Route::resource('solicitud/emision', 'emisionController', array('only'=>array('index','store')));
		Route::resource('solicitud/inscripcion', 'solicitudreinscripcionController', array('only'=>array('index','store')));
		Route::resource('solicitudespendientes/inscripcion', 'solicitudesinscripcionController',array('names' => array('index' => 'solicitudespendientes.inscripcion.index')));
		Route::resource('solicitudespendientes/asignacion', 'solicitudesasignacionController');
		Route::resource('solicitudespendientes/emision', 'solicitudesemisionController');

		Route::resource('historicosolicitudes/inscripcion', 'historicoinscripcionesController');
		Route::resource('historicosolicitudes/asignacion', 'historicoasignacionesController');
		Route::resource('historicosolicitudes/emision', 'historicoemisionesController');
		Route::get('historicosolicitudes/inscripcion/archivos/{id}', array('as'=>'historicosolicitudes.inscripcion.archivos','uses'=>'historicoinscripcionesController@archivos'));
		Route::get('historicosolicitudes/asignacion/archivos/{id}', array('as'=>'historicosolicitudes.asignacion.archivos','uses'=>'historicoasignacionesController@archivos'));
		Route::get('historicosolicitudes/emision/archivos/{id}', array('as'=>'historicosolicitudes.emision.archivos','uses'=>'historicoemisionesController@archivos'));
		
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
		Route::resource('periodospenalizaciones','periodospenalizacionesController', array('only'=>array('index','store')));
		Route::resource('partidasarancelarias','contingentepartidaController');
		Route::resource('paises','paisesController');
		Route::resource('unidadesmedida','unidadesmedidaController');
		Route::resource('usuarioempresas','usuariosdeempresaController');
		Route::resource('usuariosextra','usuariosextraController');

		//=== CERTIFICADOS
		Route::get('certificados', array('as'=>'certificados.index', 'uses'=>'certificadosController@index'));







		//Route::resource('certificados', 'certificadosController', array('only'=>array('index','show')));
		Route::get('certificados/anular/{id}', array('as'=>'certificados.anular', 'uses'=>'certificadosController@anular'));
		Route::post('certificados/anular/{id}', array('as'=>'certificados.procesaranulacion', 'uses'=>'certificadosController@procesaranulacion'));
		Route::get('certificados/liquidar/{id}', array('as'=>'certificados.liquidar', 'uses'=>'certificadosController@liquidar'));
		Route::post('certificados/liquidar/{id}', array('as'=>'certificados.procesarliquidacion', 'uses'=>'certificadosController@procesarliquidacion'));
		Route::get('buscarcertificados', array('as'=>'certificados.buscar', 'uses'=>'certificadosController@buscar'));


		//=== REPORTES
		Route::resource('cuentacorriente', 'cuentacorrienteController', array('only'=>array('index','store')));
		Route::resource('cuentacorrienteempresas', 'cuentacorrienteempresasController', array('only'=>array('index','store')));
		Route::resource('empresas', 'empresasController', array('only'=>array('index', 'store')));
		Route::resource('utilizacion', 'utilizacionController', array('only'=>array('index', 'store')));
		Route::resource('consolidadoutilizacion', 'consolidadoutilizacionController', array('only'=>array('index', 'store')));
		Route::resource('utilizacionporempresa', 'utilizacionempresaController', array('only'=>array('index', 'store')));
		Route::resource('utilizacionporempresagrafica', 'utilizacionempresagraficaController', array('only'=>array('index', 'store')));
		Route::get('tratado/graficas/saldo/{id}', array('as'=>'tratado.graficas.saldo', 'uses'=>'graficasController@saldo'));
	  
	  //=== ADMIN
	  Route::resource('usuarioswebservice', 'usuarioswebserviceController');
	});
});