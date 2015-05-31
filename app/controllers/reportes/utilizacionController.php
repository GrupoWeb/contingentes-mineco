<?php

class utilizacionController extends BaseController {
  
  public function index() {
    return View::make('reportes.filtros')
      ->with('titulo', 'Utilización de contingentes')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('tratados', 'fechaini', 'fechafin'));
  }

  public function store() {
    $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
    $contingenteid = Crypt::decrypt(Input::get('contingentes'));
    $empresaid     = Crypt::decrypt(Input::get('cmbEmpresa'));
    $fi            = Input::get('fechaini');
    $ff            = Input::get('fechafin');
    $formato       = Input::get('formato');

    //Validamos el tipo de tratado para mostrar cantidad asignada, de lo contrario
    //solo mandamos la suma de lo adjudicado
    $asignacion    = Contingente::getTipoTratado($contingenteid);
  
    $utilizaciones = Movimiento::getUtilizaciones($contingenteid, $empresaid, ($fi <> '' ? Components::fechaHumanoAMysql($fi) : ''), ($ff <> '' ? Components::fechaHumanoAMysql($ff) : ''));
    $data          = array();
    foreach($utilizaciones as $utilizacion) {
      $data[$utilizacion->nit][$utilizacion->razonsocial]['asignado'] = $utilizacion->asignado;

      if(isset($data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado']))
        $data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado'] += $utilizacion->cantidad;
      else
        $data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado'] = $utilizacion->cantidad;
      
      $data[$utilizacion->nit][$utilizacion->razonsocial]['movimientos'][] = array(
        'fecha'            => $utilizacion->fecha,
        'certificado'      => $utilizacion->numerocertificado,
        'fraccion'         => $utilizacion->fraccion,
        'fechavencimiento' => $utilizacion->fechavencimiento,
        'dua'              => $utilizacion->dua,
        'real'             => $utilizacion->real,
        'cif'              => $utilizacion->cif,
        'fechaliquidacion' => $utilizacion->fechaliquidacion,
        'cantidad'         => $utilizacion->cantidad,
        'variacion'        => $utilizacion->variacion
      );
    }

    if($formato == 'pdf') {
      PDF::SetTitle('Utilización de contingentes');
      PDF::AddPage();
      PDF::setLeftMargin(20);

      $html = View::make('reportes.utilizacionespdf')
        ->with('utilizaciones', $data)
        ->with('esasignacion', $asignacion)
        ->with('titulo', 'Utilización de contingentes')
        ->with('tratado', Tratado::getNombre($tratadoid))
        ->with('producto', Contingente::getProducto($contingenteid));

      PDF::writeHTML($html, true, false, true, false, '');
      PDF::Output('Utilizacion-Contingente.pdf');
    }
    
    else {
      return View::make('reportes.utilizaciones')
        ->with('utilizaciones', $data)
        ->with('esasignacion', $asignacion)
        ->with('titulo', 'Utilización de contingentes')
        ->with('tratado', Tratado::getNombre($tratadoid) . ' | ' . $tratadoid)
        ->with('producto', Contingente::getProducto($contingenteid) . ' | ' . $contingenteid)
        ->with('formato', $formato);
    }
  }

  public function getContingentes($id) {
    $id = Crypt::decrypt($id);

    return View::make('partials/contingentelistado')
      ->with('contingentes', Contingente::getContTratado($id))
      ->with('nombre', 'contingentes')
      ->with('id', 'contingentes');
  }

  public function getEmpresas($id) {
    $id = Crypt::decrypt($id);

    return View::make('partials/empresas')
      ->with('empresas', Empresacontingente::listEmpresasContingente($id));
  }
}