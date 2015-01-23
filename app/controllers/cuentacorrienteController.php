<?php

class cuentacorrienteController extends BaseController {
	
	public function index() {
		return View::make('reportes/filtros')
			->with('titulo', 'Cuenta Corriente')
			->with('contingentes', Contingente::getContingentes())
			->with('filters', array('fechaini', 'fechafin', 'contingentes', 'periodos'));
	}

	public function store() {
		$contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
		$periodoid     = Crypt::decrypt(Input::get('cmbPeriodo'));
		$fechaini      = $this->getFechaMySql(Input::get('fechaini')).' 00:00';
		$fechafin      = $this->getFechaMySql(Input::get('fechafin')).' 23:59';

		$contingente = Contingente::find($contingenteid);
		$producto    = Producto::find($contingente->productoid);
		$tratado     = Tratado::find($contingente->tratadoid);

		return View::make('reportes/cuentacorriente')
			->with('titulo', 'Cuenta Corriente')
			->with('tratado', $tratado->nombrecorto)
			->with('producto', $producto->nombre)
			->with('movimientos', Movimiento::getCuentaCorriente($periodoid, $fechaini, $fechafin));
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