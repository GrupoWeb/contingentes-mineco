<?php

class utilizacionempresagraficaController extends BaseController {
  
  public function index() {
    return View::make('reportes.filtros')
      ->with('titulo', 'Grafica utilización de contingentes por empresa')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('contingentes','tratados','periodos'))
      ->with('todos', array());
  }

  public function store() {
    try {
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
      $periodoid     = Crypt::decrypt(Input::get('cmbPeriodo'));
    } catch (Exception $e) {
      return View::make('cancerbero::error')
        ->with('mensaje','Tratado, período o contingente inválido.');
    }

    $formato       = Input::get('formato');

    $movimientos   = Movimiento::getUtilizacionEmpresas($periodoid, 0);
  
    $tratado = Contingente::getTratado($contingenteid);


    return View::make('reportes.utilizacionporempresagrafica')
      ->with('movimientos', $movimientos)
      ->with('esAsignacion', $tratado->asignacion)
      ->with('titulo', 'Gráfica utilización de contingentes por empresa')
      ->with('tratado', $tratado->nombre)
      ->with('producto', Contingente::getProducto($contingenteid))
      ->with('formato', $formato);
  }
}