<?php

class utilizacionController extends BaseController {
  
  public function index() {
    return View::make('reportes.filtros')
      ->with('titulo', 'Utilización de contingentes')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('tratados','contingentes', 'empresas',
        'fechaini', 'fechafin','formato'))
      ->with('todos',['empresas']);
  }

  public function store() {
    try {
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('cmbContingente'));
      $empresaid     = Crypt::decrypt(Input::get('cmbEmpresa'));
    } catch (Exception $e) {
      return View::make('cancerbero::error')
        ->with('mensaje','Tratado, contingente o empresa inválida.');
    }

    if ($empresaid==-1) $empresaid = 0;

    $fi            = Input::get('fechaini') . ' 00:00';
    $ff            = Input::get('fechafin') . ' 23:59';
    $formato       = Input::get('formato');

    //Validamos el tipo de tratado para mostrar cantidad asignada, de lo contrario
    //solo mandamos la suma de lo adjudicado
    $asignacion    = Contingente::getTipoTratado($contingenteid);
  
    $utilizaciones = Movimiento::getUtilizaciones($contingenteid, $empresaid, ($fi <> '' ? Components::fechaHumanoAMysql($fi) : ''), ($ff <> '' ? Components::fechaHumanoAMysql($ff) : ''));
    //dd(DB::getQueryLog());

    $data          = array();
    foreach($utilizaciones as $utilizacion) {
      $data[$utilizacion->nit][$utilizacion->razonsocial]['asignado'] = $utilizacion->asignado;
      $data[$utilizacion->nit][$utilizacion->razonsocial]['volumentotal'] = $utilizacion->volumentotal;
      
      if ($utilizacion->tipomovimientoid==2) {       
        if(isset($data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado']))
          $data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado'] += $utilizacion->cantidad;
        else
          $data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado'] = $utilizacion->cantidad;

        $fraccion = explode(' ', $utilizacion->fraccion);

        $data[$utilizacion->nit][$utilizacion->razonsocial]['movimientos'][] = array(
          'fecha'            => $utilizacion->fecha,
          'certificado'      => $utilizacion->numerocertificado,
          'fraccion'         => $fraccion[0],
          'fechavencimiento' => $utilizacion->fechavencimiento,
          'dua'              => $utilizacion->dua,
          'real'             => $utilizacion->real,
          'cif'              => $utilizacion->cif,
          'fechaliquidacion' => $utilizacion->fechaliquidacion,
          'cantidad'         => $utilizacion->cantidad,
          'variacion'        => $utilizacion->variacion
        );
      }
      else {
        if (!isset($data[$utilizacion->nit][$utilizacion->razonsocial]['movimientos']))
          $data[$utilizacion->nit][$utilizacion->razonsocial]['movimientos'] = array();
        if (!isset($data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado']))
          $data[$utilizacion->nit][$utilizacion->razonsocial]['adjudicado'] = 0;
      }
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
        ->with('tratado', Tratado::getNombre($tratadoid))
        ->with('producto', Contingente::getProducto($contingenteid))
        ->with('formato', $formato);
    }
  }

  public function getContingentes($id) {
    $id        = Crypt::decrypt($id);
    $empresaid = Auth::user()->empresaid;

    if ($empresaid) 
      $contingentes = Contingente::getContTratadoEmpresa($id, $empresaid);
    else
      $contingentes = Contingente::getContTratado($id);

    return View::make('partials/contingentelistado')
      ->with('contingentes', $contingentes)
      ->with('nombre', 'cmbContingente')
      ->with('id', 'cmbContingente');
  }

  public function getEmpresas($id) {
    try {
      $id = Crypt::decrypt($id);
    } catch (Exception $e) {
      return View::make('partials/empresas')
        ->with('empresas', array());
    }
      

    return View::make('partials/empresas')
      ->with('empresas', Empresacontingente::listEmpresasContingente($id));
  }
}