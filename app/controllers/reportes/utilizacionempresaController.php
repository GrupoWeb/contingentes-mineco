<?php

class utilizacionempresaController extends BaseController {
  
  public function index() {
    $empresaid = Auth::user()->empresaid;

    if($empresaid) {
      $tratados = Tratado::getTratadosEmpresa($empresaid);
      $filters  = array('tratados','contingentes', 'periodos','formato');
    }
    else {
      $tratados = Tratado::getTratados();
      $filters = array('tratados','contingentes', 'periodos','formato','empresas');
    }

    return View::make('reportes.filtros')
      ->with('titulo', 'Utilización de contingentes por empresa')
      ->with('tratados', $tratados)
      ->with('filters', $filters)
      ->with('todos', array());
  }

  public function store() {
    try {
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
      $periodoid     = Crypt::decrypt(Input::get('cmbPeriodo'));
    } catch (Exception $e) {
        return View::make('cancerbero::error')
          ->with('mensaje','Período inválido.');
    }

    $empresaid     = Auth::user()->empresaid;
    $formato       = Input::get('formato');

    $movimientos   = Movimiento::getUtilizacionEmpresas($periodoid, $empresaid);
   
    $tratado = Contingente::getTratado($contingenteid); 
    //dd($movimientos);
    return View::make('reportes.utilizacionporempresa')
      ->with('movimientos', $movimientos)
      ->with('titulo', 'Utilización de contingentes por empresa')
      ->with('tratado', $tratado->nombre)
      ->with('esAsignacion', $tratado->asignacion)
      ->with('producto', Contingente::getProducto($contingenteid))
      ->with('formato', $formato);
  }
}