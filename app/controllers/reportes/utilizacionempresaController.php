<?php

class utilizacionempresaController extends BaseController {
  
  public function index() {
    return View::make('reportes.filtros')
      ->with('titulo', 'Utilización de contingentes por empresa')
      ->with('tratados', Tratado::getTratados())
      ->with('filters', array('solotratados'));
  }

  public function store() {
    $tratadoid     = Crypt::decrypt(Input::get('tratadoid'));
    $contingenteid = Crypt::decrypt(Input::get('contingentes'));
    $formato       = Input::get('formato');

    $movimientos   = Movimiento::getUtilizacionEmpresas($tratadoid, $contingenteid);
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

        $vals = array('asignado'=>0,'emitido'=>0,'liquidado'=>$liquidado,'saldo'=>0);
        if($movimiento->tipomovimientoid == $autorizado)
          $vals['asignado'] = $movimiento->monto;

        if($movimiento->tipomovimientoid == $certificado)
          $vals['emitido'] = $movimiento->monto;

        if($movimiento->asignacion == 1)
          $vals['saldo'] = ($vals['asignado'] - $liquidado);
        else
          $vals['saldo'] = ($vals['emitido'] - $liquidado);

        $data[$movimiento->nombre][$movimiento->razonsocial] = $vals;
        $asigns[$movimiento->nombre]                         = $movimiento->asignacion;
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

    //return Response::json($totales);

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