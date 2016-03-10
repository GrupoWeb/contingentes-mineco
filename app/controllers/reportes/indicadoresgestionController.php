<?php

class indicadoresgestionController extends BaseController {
  
  public function index() {
    return View::make('reportes.filtros')
      ->with('titulo', 'Indicadores de Gestión')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('tratados',
        'fechaini', 'fechafin','formato'))
      ->with('todos',['empresas']);
  }

  public function store() {
  	try {
      $tratadoid = Crypt::decrypt(Input::get('tratadoid'));
    } catch (Exception $e) {
      return View::make('cancerbero::error')
        ->with('mensaje','Tratado, contingente o empresa inválida.');
    }

    $tratado  = Tratado::getNombre($tratadoid);
    $empresas = Contingente::getIndicadores($tratadoid);
    $datos    = [];
    foreach($empresas as $empresa) {
    	$empresaid    = DB::table('empresas')->where('razonsocial', $empresa->empresa)->pluck('empresaid');
    	$asignaciones = Solicitudasignacion::getIndicadores($empresa->contingenteid, $empresaid);
    	$emisiones    = Solicitudesemision::getIndicadores($empresa->contingenteid, $empresaid);

    	$datos[$empresa->contingente][$empresa->empresa]['inscripcion'] = [
				'solicitud'     => $empresa->fechasolicitud,
				'proceso'       => $empresa->fechaprocesamiento,
				'responsable'   => $empresa->responsable,
				'observaciones' => $empresa->observaciones,
    	];

    	foreach($asignaciones as $asignacion) {
    		$datos[$empresa->contingente][$empresa->empresa]['asignaciones'][] = [
					'solicitud'     => $asignacion->fechasolicitud,
					'proceso'       => $asignacion->fechaprocesamiento,
					'solicitado'    => $asignacion->solicitado,
					'asignado'      => $asignacion->asignado,
					'acta'          => $asignacion->acta,
					'observaciones' => $asignacion->observaciones,
    		];
    	}

    	foreach($emisiones as $emision) {
    		$datos[$empresa->contingente][$empresa->empresa]['emisiones'][] = [
					'solicitud'     => $emision->fechasolicitud,
					'proceso'       => $emision->fechaprocesamiento,
					'solicitado'    => $emision->solicitado,
					'emitido'       => $emision->emitido,
					'partida'       => $emision->partida,
					'observaciones' => $emision->observaciones,
    		];
    	}
    }
    //dd($datos);
    return View::make('reportes.indicadoresdegestion')
    	->with('datos', $datos)
    	->with('formato', Input::get('formato'))
    	->with('titulo', 'Indicadores de Gestión')
			->with('tratado', $tratado)
      ->with('producto', '');
  }
}

