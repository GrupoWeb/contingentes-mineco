<?php

class cuentacorrienteempresasController extends BaseController {
	
	public function index() {
		return View::make('reportes/filtros')
			->with('titulo', 'Cuenta Corriente - Empresas')
			->with('contingentes', Contingente::getContingentesCuota())
			->with('filters', array('contingentes', 'periodos','empresas'));
	}

	public function store() {
		$empresaId = null;
		if (Input::has('cmbEmpresa')) {
			$empresaId = Crypt::decrypt(Input::get('cmbEmpresa'));
		}
		$periodoId = Crypt::decrypt(Input::get('cmbPeriodo'));
		$periodo   = Periodo::getPeriodoInfo($periodoId);

		return View::make('reportes/cuentacorrienteempresas')
			->with('titulo', 'Cuenta Corriente - Empresas')
			->with('tratado', $periodo->tratado)
			->with('producto', $periodo->producto)
			->with('movimientos', Movimiento::getCuentaCorrienteEmpresa($periodoId, $empresaId));
	}

	public function getEmpresas($aContingenteId) {
		return View::make('partials/empresas')
			->with('empresas', Empresacontingente::getEmpresasContingente(Crypt::decrypt($aContingenteId)));
	}
}