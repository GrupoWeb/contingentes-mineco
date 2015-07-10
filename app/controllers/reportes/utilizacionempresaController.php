<?php

class utilizacionempresaController extends BaseController {
  
  public function index() {
    $empresaid = Auth::user()->empresaid;

    if($empresaid) 
      $tratados = Tratado::getTratadosEmpresa($empresaid);
    else 
      $tratados = Tratado::getTratados();

    return View::make('reportes.filtros')
      ->with('titulo', 'Utilización de contingentes por empresa')
      ->with('tratados', $tratados)
      ->with('filters', array('solotratados','formato'));
  }

  public function store() {
    try {
      $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
      $contingenteid = Crypt::decrypt(Input::get('contingentes'));
    } catch (Exception $e) {
            return View::make('cancerbero::error')
        ->with('mensaje','Tratado, contingente inválido.');
    }

    $empresaid     = Auth::user()->empresaid;
    $formato       = Input::get('formato');

    $movimientos   = Movimiento::getUtilizacionEmpresas($tratadoid, $contingenteid, $empresaid);
    $autorizado    = DB::table('tiposmovimiento')->where('nombre', 'Asignación')->pluck('tipomovimientoid');
    $certificado   = DB::table('tiposmovimiento')->where('nombre', 'Certificado')->pluck('tipomovimientoid');
    $data          = array();
    $asigns        = array();
    $totales       = array();

    foreach($movimientos as $movimiento) {
      if($movimiento->tipomovimientoid == $autorizado || $movimiento->tipomovimientoid == $certificado) {
        $liquidado = 0;
        if($movimiento->certificadoid)
          $liquidado = Certificado::getLiquidado($movimiento->certificadoid);

        $vals = array(
          'asignado'  => (isset($data[$movimiento->producto][$movimiento->razonsocial]['asignado']) ? $data[$movimiento->producto][$movimiento->razonsocial]['asignado'] : 0),
          'emitido'   => (isset($data[$movimiento->producto][$movimiento->razonsocial]['emitido']) ? $data[$movimiento->producto][$movimiento->razonsocial]['emitido'] : 0),
          'liquidado' => $liquidado,
          'saldo'     => (isset($data[$movimiento->producto][$movimiento->razonsocial]['saldo']) ? $data[$movimiento->producto][$movimiento->razonsocial]['saldo'] : 0)
        );

        if($movimiento->tipomovimientoid == $autorizado)
          $vals['asignado'] = $movimiento->monto;

        if($movimiento->tipomovimientoid == $certificado)
          $vals['emitido'] = $movimiento->monto*-1;

        if($movimiento->asignacion == 1)
          $vals['saldo'] = ($vals['asignado'] - $vals['emitido']);
        else
          $vals['saldo'] = ($vals['emitido'] - $vals['emitido']);

        $data[$movimiento->producto][$movimiento->razonsocial] = $vals;
        $asigns[$movimiento->producto]                         = $movimiento->asignacion;
      }
    }

    foreach($data as $contingente=>$valores) {
      $totalautorizado=0; $totalasignado=0; $totalimportado=0; $totalsaldo=0;
      
      foreach($valores as $empresa=>$lectura) {
        $totalautorizado += $lectura['asignado']; 
        $totalasignado   += $lectura['emitido']; 
        $totalimportado  += $lectura['liquidado']; 
        $totalsaldo      += $lectura['saldo']; 
      }

      $totales[$contingente] = array(
        'totalasignacion' => $totalautorizado,
        'totalemitido'    => $totalasignado,
        'totalimportado'  => $totalimportado,
        'totalsaldo'      => $totalsaldo
      );
    }

    return View::make('reportes.utilizacionporempresa')
      ->with('movimientos', $data)
      ->with('asignaciones', $asigns)
      ->with('totales', $totales)
      ->with('titulo', 'Utilización de contingentes por empresa')
      ->with('tratado', Tratado::getNombre($tratadoid))
      ->with('producto', Contingente::getProducto($contingenteid))
      ->with('formato', $formato);
  }
}