<?php

class certificadosController extends Controller {

	public function index() {
		return View::make('certificados.filtros')
      ->with('titulo', 'Certificados')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('tratados', 'contingentes', 'periodos', 'empresas', 'fechaini', 'fechafin'))
      ->with('todos',['tratados']);
	}







	public function getcontingentes($id) {
		$id        = Crypt::decrypt($id);
		$empresaid = Auth::user()->empresaid;

    if ($empresaid) 
      $contingentes = Contingente::getContTratadoEmpresa($id, $empresaid);
    else
      $contingentes = Contingente::getContTratado($id);

		return View::make('partials.certificados.contingentes')
      ->with('contingentes', $contingentes)
      ->with('nombre', 'cmbContingente')
      ->with('id', 'cmbContingente');
	}

	public function getperiodos($id) {
		return View::make('partials.certificados.periodos')
      ->with('periodos', Periodo::getPeriodosContingente(Crypt::decrypt($id)))
      ->with('nombre', 'cmbPeriodos')
      ->with('id', 'cmbPeriodos');
	}

	public function getempresas($id) {
		$id        = Crypt::decrypt($id);
		$empresaid = Auth::user()->empresaid;

		return View::make('partials.certificados.empresas')
      ->with('empresas', Empresa::getEmpresasPeriodo($id, $empresaid))
      ->with('nombre', 'cmbEmpresas')
      ->with('id', 'cmbEmpresas');
	}
}