<?php

class cuentacorrienteController extends BaseController {
	
	public function index() {
		return View::make('reportes/filtros')
			->with('titulo', 'Cuenta Corriente - Contingentes')
			->with('tratados', Tratado::getTratados())
			->with('contingentes', Contingente::getContingentes())
			->with('filters', array('tratados','contingentes', 'periodos','formato'))
    	->with('todos', array());
	}

	public function store() {
		$periodoId = Crypt::decrypt(Input::get('cmbPeriodo'));
		$periodo   = Periodo::getPeriodoInfo($periodoId);
		$formato   = Input::get('formato');

		if($formato == 'pdf') {
			PDF::SetTitle('Cuenta Corriente - Contingentes');
			PDF::AddPage();
			PDF::setLeftMargin(20);

			$html = View::make('reportes/cuentacorrientepdf')
				->with('titulo', 'Cuenta Corriente - Contingentes')
				->with('tratado', $periodo->tratado)
				->with('producto', $periodo->producto)
				->with('movimientos', Movimiento::getCuentaCorriente($periodoId))
				->with('formato', 'html');

			PDF::writeHTML($html, true, false, true, false, '');
			PDF::Output('CC-Contingente.pdf');
		}

		else {
			return View::make('reportes/cuentacorriente')
				->with('titulo', 'Cuenta Corriente - Contingentes')
				->with('tratado', $periodo->tratado)
				->with('producto', $periodo->producto)
				->with('movimientos', Movimiento::getCuentaCorriente($periodoId))
				->with('formato', $formato);
		}
	}

	public function getPeriodos($aContingenteId) {
		$response = array('codigoerror'=>0, 'error'=>'', 'data' => '');
		$periodos = Periodo::getPeriodosContingente(Crypt::decrypt($aContingenteId));

		if ((count($periodos) <= 0) && !Input::has('todos')) {
			$response['codigoerror'] = 1;
			$response['error']       = 'No se tienen períodos activos para el contingente seleccionado';
		}

		else
			$response['data'] = View::make('partials/periodos')->with('periodos', $periodos)->render();
		
		return Response::json($response);
	}

	private function getFechaMySql($aFecha) {
		$arr = explode('/', $aFecha);
		return $arr[2].'-'.$arr[1].'-'.$arr[0];
	}
}