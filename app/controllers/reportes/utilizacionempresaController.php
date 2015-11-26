<?php

class utilizacionempresaController extends BaseController {
  
  public function index() {
    //captura id empresa
    $empresaid = Auth::user()->empresaid;

    //condiciona empresa id para consulta en db
    if($empresaid) {
      $tratados = Tratado::getTratadosEmpresa($empresaid);
      $filters  = array('tratados','contingentes', 'periodos','formato');
    }
    else {
      $tratados = Tratado::getTratados();
      $filters = array('tratados','contingentes', 'periodos','formato','empresas');
    }

    //retorna datos en la vista
    return View::make('reportes.filtros')
      ->with('titulo', 'Utilización de contingentes por empresa')
      ->with('tratados', $tratados)
      ->with('filters', $filters)
      ->with('todos', array('empresas'));
  }

  public function store() {
    try {
      //asigna valores del formulario
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
      $periodoid     = Crypt::decrypt(Input::get('cmbPeriodo'));
    } catch (Exception $e) {
        return View::make('cancerbero::error')
          ->with('mensaje','Período inválido.');
    }

    //asigna valores a las variables
    $empresaid     = Auth::user()->empresaid;
    $formato       = Input::get('formato');
    $movimientos   = Movimiento::getUtilizacionEmpresas($periodoid, $empresaid);
    $tratado       = Contingente::getTratado($contingenteid); 

    //valida formato a pdf
    if($formato == 'pdf') {
      PDF::SetTitle('Cuenta Corriente - Contingentes');
      PDF::AddPage();
      PDF::setLeftMargin(20);

      $html = View::make('reportes.utilizacionporempresapdf')
        ->with('movimientos', $movimientos)
        ->with('titulo', 'Utilización de contingentes por empresa')
        ->with('tratado', $tratado->nombre)
        ->with('esAsignacion', $tratado->asignacion)
        ->with('producto', Contingente::getProducto($contingenteid))
        ->with('formato', $formato);

      PDF::writeHTML($html, true, false, true, false, '');
      PDF::Output('utilizacion-por-empresa.pdf');
    }

    else {
      //retorna datos a la vista
      return View::make('reportes.utilizacionporempresa')
        ->with('movimientos', $movimientos)
        ->with('titulo', 'Utilización de contingentes por empresa')
        ->with('tratado', $tratado->nombre)
        ->with('esAsignacion', $tratado->asignacion)
        ->with('producto', Contingente::getProducto($contingenteid))
        ->with('formato', $formato);
    }
  }
}