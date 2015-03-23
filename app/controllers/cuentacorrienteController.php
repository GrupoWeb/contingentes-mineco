<?php

class cuentacorrienteController extends BaseController {
	
	public function index() {
		return View::make('reportes/filtros')
			->with('titulo', 'Cuenta Corriente - Contingentes')
			->with('contingentes', Contingente::getContingentes())
			->with('filters', array('contingentes', 'periodos'));
	}

	public function store() {
		$periodoId = Crypt::decrypt(Input::get('cmbPeriodo'));
		$periodo   = Periodo::getPeriodoInfo($periodoId);

		return View::make('reportes/cuentacorriente')
			->with('titulo', 'Cuenta Corriente - Contingentes')
			->with('tratado', $periodo->tratado)
			->with('producto', $periodo->producto)
			->with('movimientos', Movimiento::getCuentaCorriente($periodoId));
	}

	public function getPeriodos($aContingenteId) {
		return View::make('partials/periodos')
			->with('periodos', Periodo::getPeriodosContingente(Crypt::decrypt($aContingenteId)));
	}

	private function getFechaMySql($aFecha) {
		$arr = explode('/', $aFecha);
		return $arr[2].'-'.$arr[1].'-'.$arr[0];
	}
}