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
//Temp plantillas
Route::get('plantilla1', 'plantillaController@plantilla1');
Route::get('plantilla2', 'plantillaController@plantilla2');
Route::get('plantilla3', 'plantillaController@plantilla3');

//Legacy
Route::get('api/vupe/', 'apiController@vupeLegacy');

//Informativas
Route::get('/', ['as' => 'index.index', 'uses' => 'homeController@index']);
Route::get('acuerdoscomerciales', ['as' => 'index.index', 'uses' => 'homeController@acuerdoscomerciales']);
Route::get('manuales', ['as' => 'index.index', 'uses' => 'homeController@manuales']);

//API
Route::group(['prefix' => 'api', 'before' => ['auth.basic']], function () {
    Route::get('certificado/{id}', 'apiController@certificado');
    Route::get('empresaestavigentexnit', 'apiController@empresavigente');
    Route::get('listadocontingentesnittratado', 'apiController@listadocontingentes');
    Route::get('partidasarancelariasxcontingente', 'apiController@partidascontingente');
    Route::get('cuentacorriente', 'apiController@cuentacorriente');
    Route::get('solicitudasignacion', 'apiController@solicitudasignacion');
    Route::get('solicitudemision', 'apiController@solicitudemision');

    //=== SAT
    Route::get('sat/enviarcertificados', 'apiController@enviarcertificados');
    Route::get('sat/estadocertificados', 'apiController@estadocertificados');
    Route::post('certificados/{id}', 'certificadosController@update');
});

//FILTROS DE CERTIFICADOS
Route::get('certificados/contingentes/{id}', 'certificadosController@getcontingentes');
Route::get('certificados/periodos/{id}', 'certificadosController@getperiodos');
Route::get('certificados/empresas/{id}', 'certificadosController@getempresas');

Route::group(['before' => ['tratados']], function () {
    Route::get('c/{id}', ['as' => 'certificados.generar', 'uses' => 'certificadosController@generarPDF']);
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

    Route::group(['before' => ['auth', 'cancerbero', 'menu']], function () {
        Route::get('inicio', ['as' => 'index.index', 'uses' => 'dashboardController@index']);

        //=== SOLICITUDES
        Route::resource('solicitud/asignacion', 'asignacionController', ['only' => ['index', 'store']]);
        Route::resource('solicitud/emision', 'emisionController', ['only' => ['index', 'store']]);
        Route::resource('solicitud/inscripcion', 'solicitudreinscripcionController', ['only' => ['index', 'store']]);
        Route::resource('solicitud/actualizacion', 'actualizacionController', ['only' => ['index', 'store']]);
        Route::resource('solicitudliquidacion', 'solicitudliquidacionController', ['only' => ['index', 'store', 'show']]);
        Route::resource('solicitudespendientes/inscripcion', 'solicitudesinscripcionController', ['names' => ['index' => 'solicitudespendientes.inscripcion.index']]);
        Route::resource('solicitudespendientes/asignacion', 'solicitudesasignacionController');
        Route::resource('solicitudespendientes/emision', 'solicitudesemisionController');
        Route::resource('solicitudespendientes/actualizacion', 'solicitudactualizacionController');
        Route::resource('solicitudespendientes/liquidacion', 'liquidacionController');

        Route::resource('historicosolicitudes/inscripcion', 'historicoinscripcionesController');
        Route::resource('historicosolicitudes/asignacion', 'historicoasignacionesController');
        Route::resource('historicosolicitudes/emision', 'historicoemisionesController');
        Route::resource('historicosolicitudes/actualizacion', 'historicoactualizacionesController');
        Route::resource('historicosolicitudes/liquidacion', 'historicoliquidacionesController');
        Route::get('historicosolicitudes/inscripcion/archivos/{id}', ['as' => 'historicosolicitudes.inscripcion.archivos', 'uses' => 'historicoinscripcionesController@archivos']);
        Route::get('historicosolicitudes/asignacion/archivos/{id}', ['as' => 'historicosolicitudes.asignacion.archivos', 'uses' => 'historicoasignacionesController@archivos']);
        Route::get('historicosolicitudes/emision/archivos/{id}', ['as' => 'historicosolicitudes.emision.archivos', 'uses' => 'historicoemisionesController@archivos']);
        Route::get('historicosolicitudes/actualizacion/archivos/{id}', ['as' => 'historicosolicitudes.actualizacion.archivos', 'uses' => 'historicoactualizacionesController@archivos']);
        Route::get('historicosolicitudes/liquidacion/archivos/{id}', ['as' => 'historicosolicitudes.liquidacion.archivos', 'uses' => 'historicoliquidacionesController@archivos']);

        //=== CONTINGENTES
        Route::get('contingente/requerimientos/{id}', ['as' => 'contingente.requerimientos.index', 'uses' => 'contingenterequerimientosController@index']);
        Route::post('contingente/requerimientos/store', ['as' => 'contingente.requerimientos.store', 'uses' => 'contingenterequerimientosController@store']);

        //=== CATALOGOS
        Route::resource('productos', 'productosController');
        Route::resource('tratados', 'tratadosController');
        Route::resource('requerimientos', 'requerimientosController');
        Route::resource('contingentes', 'contingentesController');
        Route::resource('periodos', 'periodosController');
        Route::resource('periodosasignaciones', 'periodosasignacionesController', ['only' => ['index', 'store']]);
        Route::resource('periodospenalizaciones', 'periodospenalizacionesController', ['only' => ['index', 'store']]);
        Route::resource('partidasarancelarias', 'contingentepartidaController');
        Route::resource('paises', 'paisesController');
        Route::resource('unidadesmedida', 'unidadesmedidaController');
        Route::resource('usuarioempresas', 'usuariosdeempresaController');
        Route::resource('usuariosextra', 'usuariosextraController');
        Route::resource('periodoconstancias', 'periodoconstanciasController', ['only' => ['index', 'show']]);
        Route::resource('catalogonoticias', 'catalogonoticiasController');

        //=== CERTIFICADOS
        Route::resource('certificados', 'certificadosController', ['only' => ['index', 'store']]);
        Route::get('certificados/anular/{id}', ['as' => 'certificados.anular', 'uses' => 'certificadosController@anular']);
        Route::post('certificados/anular/{id}', ['as' => 'certificados.procesaranulacion', 'uses' => 'certificadosController@procesaranulacion']);

        //=== REPORTES
        Route::resource('cuentacorriente', 'cuentacorrienteController', ['only' => ['index', 'store']]);
        Route::resource('cuentacorrienteempresas', 'cuentacorrienteempresasController', ['only' => ['index', 'store']]);
        Route::resource('empresas', 'empresasController', ['only' => ['index', 'store']]);
        Route::resource('utilizacion', 'utilizacionController', ['only' => ['index', 'store']]);
        Route::resource('consolidadoutilizacion', 'consolidadoutilizacionController', ['only' => ['index', 'store']]);
        Route::resource('utilizacionporempresa', 'utilizacionempresaController', ['only' => ['index', 'store']]);
        Route::resource('utilizaciontodasempresa', 'utilizaciontodasempresaController', ['only' => ['index', 'store']]);
        Route::resource('utilizacionporempresagrafica', 'utilizacionempresagraficaController', ['only' => ['index', 'store']]);
        Route::resource('certificadosempresas', 'certificadosempresasController', ['only' => ['index', 'store']]);
        Route::resource('indicadoresgestion', 'indicadoresgestionController', ['only' => ['index', 'store']]);

        //=== NOTICIAS
        Route::get('noticas', ['as' => 'noticias.index', 'uses' => 'noticiasController@index']);
        Route::get('noticas/{id}', ['as' => 'noticias.show', 'uses' => 'noticiasController@show']);

        Route::get('tratado/graficas/saldo/{id}', ['as' => 'tratado.graficas.saldo', 'uses' => 'graficasController@saldo']);

        //=== ADMIN
        Route::resource('usuarioswebservice', 'usuarioswebserviceController');
    });
});
