<?php

class consolidadoutilizacionController extends BaseController {
	
	public function index() {
		//retorna valores a la vista
		return View::make('reportes/filtros')
			->with('titulo', 'Consolidado de utilización de contingentes')
			->with('contingentes', Contingente::getContingentes())
			->with('filters', array('fechaini','fechafin','formato'))
			->with('todos', array());
	}

	public function store() {
		//recibe valores del formulario
		$formato  = Input::get('formato');
		$fi       = Input::get('fechaini') . ' 00:00';
    $ff       = Input::get('fechafin') . ' 23:59';

		$finicio = '';
		if($fi <> '')
			$finicio = Components::fechaHumanoAMysql($fi);

		$ffin = '';
		if($ff <> '')
			$ffin = Components::fechaHumanoAMysql($ff);

		//consulta en db segun parametros 
		$tratados = Movimiento::getConsolidadoUtilizacion($finicio, $ffin);
		$data     = array();
		$tipos    = array();

		//pasa valores del objeto a un areglo
		foreach($tratados as $tratado) {
			$data[$tratado->nombrecorto]['tipo']    = $tratado->tipocorto;
			$data[$tratado->nombrecorto]['datos'][] = array(
				'producto'  => $tratado->nombre,
				'partidas'  => Contingentepartida::listPartidas($tratado->contingenteid),
				'activado'  => $tratado->activado,
				'asignado'  => $tratado->asignado,
				'emitido'   => $tratado->emitido,
				'utilizado' => ($tratado->activado <> 0 ? number_format((($tratado->emitido * 100) / $tratado->activado), 2) : 0)
			);

			$tipos[$tratado->tipocorto] = $tratado->tipo;
		}

		//valida formato pdf
		if($formato == 'pdf') {
			PDF::SetTitle('Consolidado utilización de contingentes');
      PDF::AddPage();
      PDF::setLeftMargin(20);

      //retorna datos pdf
      $html = View::make('reportes.consolidadoutilizacionpdf')
				->with('titulo', 'Consolidado de utilización de contingentes')
				->with('tratado', '')
	      ->with('producto', '')
				->with('formato', $formato)
				->with('tratados', $data)
				->with('tipos', $tipos);

      PDF::writeHTML($html, true, false, true, false, '');
      PDF::Output('Consolidado-utilizacion-Contingente.pdf');
		}

		else {
			//retorna datos a la vista
			return View::make('reportes.consolidadoutilizacion')
				->with('titulo', 'Consolidado de utilización de contingentes')
				->with('tratado', '')
	      ->with('producto', '')
				->with('formato', $formato)
				->with('tratados', $data)
				->with('tipos', $tipos);
		}
	}
}